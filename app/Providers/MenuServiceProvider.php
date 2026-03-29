<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use stdClass;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    View::composer('*', function ($view): void {
      $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
      $verticalMenuData = json_decode($verticalMenuJson);

      $verticalMenuData->menu = $this->normalizeMenuHeaders(
        $this->filterMenuItems($verticalMenuData->menu ?? [])
      );

      $view->with('menuData', [$verticalMenuData]);
    });
  }

  /**
   * @param array<int, mixed> $items
   * @return array<int, mixed>
   */
  private function filterMenuItems(array $items): array
  {
    $filtered = [];

    foreach ($items as $item) {
      if (!($item instanceof stdClass)) {
        continue;
      }

      if (!$this->passesVisibilityRule($item)) {
        continue;
      }

      if (isset($item->menuHeader)) {
        $filtered[] = $item;
        continue;
      }

      if (isset($item->permission) && !$this->can($item->permission)) {
        continue;
      }

      if (isset($item->submenu) && is_array($item->submenu)) {
        $item->submenu = $this->filterMenuItems($item->submenu);
        if (count($item->submenu) === 0 && !isset($item->url)) {
          continue;
        }
      }

      $filtered[] = $item;
    }

    return $filtered;
  }

  /**
   * Remove menu headers that end up with no visible items.
   *
   * @param array<int, mixed> $items
   * @return array<int, mixed>
   */
  private function normalizeMenuHeaders(array $items): array
  {
    $normalized = [];
    $previousWasHeader = false;

    foreach ($items as $item) {
      if (isset($item->menuHeader)) {
        if (count($normalized) === 0 || $previousWasHeader) {
          continue;
        }

        $previousWasHeader = true;
        $normalized[] = $item;
        continue;
      }

      $previousWasHeader = false;
      $normalized[] = $item;
    }

    if (!empty($normalized)) {
      $last = end($normalized);
      if ($last instanceof stdClass && isset($last->menuHeader)) {
        array_pop($normalized);
      }
    }

    return $normalized;
  }

  private function passesVisibilityRule(stdClass $item): bool
  {
    if (!isset($item->auth)) {
      return true;
    }

    $isAuthenticated = auth()->check();

    return match ($item->auth) {
      'guest' => !$isAuthenticated,
      'auth' => $isAuthenticated,
      default => true,
    };
  }

  private function can(string $permission): bool
  {
    if (!auth()->check()) {
      return false;
    }

    $user = auth()->user();
    if (!$user || !method_exists($user, 'hasPermission')) {
      return false;
    }

    return (bool) $user->hasPermission($permission);
  }
}

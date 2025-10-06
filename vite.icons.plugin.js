import fs from 'fs/promises';
import path from 'path';
import { getIconsCSS } from '@iconify/utils';

export default function iconifyPlugin() {
  return {
    name: 'vite-iconify-plugin',
    apply: 'build', // Run only during build

    async buildStart() {
      console.log('🔨 Generating iconify CSS file...');

      try {
        const iconSetPaths = [
          path.resolve(process.cwd(), 'node_modules/@iconify/json/json/bx.json'),
          path.resolve(process.cwd(), 'node_modules/@iconify/json/json/bxl.json'),
          path.resolve(process.cwd(), 'node_modules/@iconify/json/json/bxs.json')
        ];

        const iconSets = await Promise.all(
          iconSetPaths.map(async filePath => {
            const data = await fs.readFile(filePath, 'utf-8');
            return JSON.parse(data);
          })
        );

        const allIcons = iconSets
          .map(iconSet => {
            return getIconsCSS(iconSet, Object.keys(iconSet.icons), {
              iconSelector: '.{prefix}-{name}',
              commonSelector: '.bx',
              format: 'expanded'
            });
          })
          .join('\n');

        const outputPath = path.resolve(process.cwd(), 'resources/assets/vendor/fonts/iconify/iconify.css');
        const dir = path.dirname(outputPath);
        await fs.mkdir(dir, { recursive: true });
        await fs.writeFile(outputPath, allIcons, 'utf8');

        console.log(`✅ Iconify CSS generated at: ${outputPath}`);
      } catch (error) {
        console.error('❌ Error generating Iconify CSS or copying additional files:', error);
      }
    }
  };
}

const precoCustoEl = document.getElementById('preco_custo');
const precoVendaEl = document.getElementById('preco_venda');
const margemVisualEl = document.getElementById('margem_visual');

if (precoCustoEl && precoVendaEl && margemVisualEl) {
  const formatPercent = value => value.toLocaleString('pt-BR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  });

  const recomputeMargin = () => {
    const custo = parseFloat(precoCustoEl.value || '0');
    const venda = parseFloat(precoVendaEl.value || '0');

    if (custo <= 0) {
      margemVisualEl.value = '0,00';
      return;
    }

    const margin = ((venda - custo) / custo) * 100;
    margemVisualEl.value = formatPercent(margin);
  };

  precoCustoEl.addEventListener('input', recomputeMargin);
  precoVendaEl.addEventListener('input', recomputeMargin);
  recomputeMargin();
}

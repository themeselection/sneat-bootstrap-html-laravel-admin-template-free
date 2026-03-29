const produtoEl = document.getElementById('produto_id');
const tipoEl = document.getElementById('tipo');
const ajusteWrap = document.querySelector('.ajuste-direcao-wrap');
const loteWraps = document.querySelectorAll('.lote-wrap');
const validadeWrap = document.querySelector('.validade-wrap');
const entradaWrap = document.querySelector('.entrada-wrap');

if (produtoEl && tipoEl) {
  const toggleByTipo = () => {
    const tipo = tipoEl.value;
    const isAjuste = tipo === 'AJUSTE';
    const isEntrada = tipo === 'ENTRADA';
    ajusteWrap.classList.toggle('d-none', !isAjuste);
    entradaWrap.classList.toggle('d-none', !(isEntrada || isAjuste));
  };

  const toggleByProduto = () => {
    const selected = produtoEl.options[produtoEl.selectedIndex];
    if (!selected) return;

    const controlaLote = selected.dataset.controlaLote === '1';
    const controlaValidade = selected.dataset.controlaValidade === '1';

    loteWraps.forEach(el => el.classList.toggle('d-none', !controlaLote));
    validadeWrap.classList.toggle('d-none', !controlaValidade);
  };

  tipoEl.addEventListener('change', toggleByTipo);
  produtoEl.addEventListener('change', toggleByProduto);
  toggleByTipo();
  toggleByProduto();
}

const tabela = document.querySelector('#compra-itens-table tbody');
const addBtn = document.getElementById('add-item-row');

const currency = (v) => `R$ ${Number(v || 0).toFixed(2).replace('.', ',')}`;

const renumber = () => {
  [...tabela.querySelectorAll('tr[data-row]')].forEach((row, index) => {
    row.querySelectorAll('input, select').forEach((el) => {
      const name = el.getAttribute('name');
      if (!name) return;
      el.setAttribute('name', name.replace(/itens\[\d+\]/, `itens[${index}]`));
    });
  });
};

const syncTotals = () => {
  let totalItens = 0;
  let totalValor = 0;

  [...tabela.querySelectorAll('tr[data-row]')].forEach((row) => {
    const qtd = Number(row.querySelector('.item-qtd')?.value || 0);
    const preco = Number(row.querySelector('.item-preco')?.value || 0);
    totalItens += qtd;
    totalValor += qtd * preco;
  });

  const itensEl = document.getElementById('compra-total-itens');
  const valorEl = document.getElementById('compra-total-valor');
  if (itensEl) itensEl.textContent = totalItens.toFixed(3).replace('.', ',');
  if (valorEl) valorEl.textContent = currency(totalValor);
};

const bindRow = (row) => {
  row.querySelectorAll('.item-qtd, .item-preco').forEach((el) => {
    el.addEventListener('input', syncTotals);
  });

  row.querySelector('.remove-row')?.addEventListener('click', () => {
    if (tabela.querySelectorAll('tr[data-row]').length <= 1) {
      row.querySelector('.item-produto').value = '';
      row.querySelector('.item-qtd').value = '1';
      row.querySelector('.item-preco').value = '0';
      syncTotals();
      return;
    }
    row.remove();
    renumber();
    syncTotals();
  });
};

addBtn?.addEventListener('click', () => {
  const firstRow = tabela.querySelector('tr[data-row]');
  if (!firstRow) return;
  const clone = firstRow.cloneNode(true);
  clone.querySelectorAll('input').forEach((el) => {
    if (el.type === 'number') {
      el.value = el.classList.contains('item-qtd') ? '1' : '0';
    } else if (el.type === 'date' || el.type === 'text') {
      el.value = '';
    }
  });
  clone.querySelector('select.item-produto').value = '';
  tabela.appendChild(clone);
  renumber();
  bindRow(clone);
  syncTotals();
});

[...tabela.querySelectorAll('tr[data-row]')].forEach(bindRow);
renumber();
syncTotals();

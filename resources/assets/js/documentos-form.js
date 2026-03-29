const tbody = document.querySelector('#documento-itens-table tbody');
const tipoEl = document.querySelector('[data-tipo-documento]');
const searchInput = document.getElementById('produto-search-input');
const resultsBox = document.getElementById('produto-search-results');
const searchUrl = window.documentoProdutoSearchUrl || '';
const clienteSearchInput = document.getElementById('cliente-search-input');
const clienteIdInput = document.getElementById('cliente_id');
const clienteResultsBox = document.getElementById('cliente-search-results');
const clienteMeta = document.getElementById('cliente-selected-meta');
const clienteSearchUrl = window.documentoClienteSearchUrl || '';
const statusEl = document.querySelector('[data-status-documento]');
const statusOptionsByTipo = window.documentoStatusOptionsByTipo || {};
const regrasEdicao = window.documentoRegrasEdicao || {};
const bloqueiaItens = Boolean(regrasEdicao && regrasEdicao.permite_alterar_itens === false);

const formatCurrency = (value) => `R$ ${Number(value || 0).toFixed(2).replace('.', ',')}`;

const allowItemPriceEdit = () => (tipoEl?.value || 'ORCAMENTO') === 'ORCAMENTO';

const renumberRows = () => {
  [...tbody.querySelectorAll('tr[data-row]')].forEach((row, index) => {
    row.querySelectorAll('input').forEach((el) => {
      const name = el.getAttribute('name');
      if (!name) return;
      el.setAttribute('name', name.replace(/itens\[\d+\]/, `itens[${index}]`));
    });
  });
};

const calcRow = (row) => {
  const qtdEl = row.querySelector('.item-quantidade');
  const precoEl = row.querySelector('.item-preco');
  const subtotalEl = row.querySelector('.item-subtotal');

  const qtd = Number(qtdEl.value || 0);
  const preco = Number(precoEl.value || 0);
  const subtotal = qtd * preco;
  subtotalEl.value = formatCurrency(subtotal);

  return subtotal;
};

const calcTotals = () => {
  const subtotal = [...tbody.querySelectorAll('tr[data-row]')].reduce((acc, row) => acc + calcRow(row), 0);

  const desconto = Number(document.getElementById('desconto_total')?.value || 0);
  const acrescimo = Number(document.getElementById('acrescimo_total')?.value || 0);
  const impostos = Number(document.getElementById('impostos_total')?.value || 0);
  const total = Math.max(0, subtotal - desconto + acrescimo + impostos);

  const subtotalPreview = document.getElementById('subtotal-preview');
  const totalPreview = document.getElementById('total-preview');
  if (subtotalPreview) subtotalPreview.textContent = formatCurrency(subtotal);
  if (totalPreview) totalPreview.textContent = formatCurrency(total);
};

const updatePriceMode = () => {
  const editable = allowItemPriceEdit();
  tbody.querySelectorAll('.item-preco').forEach((el) => {
    if (bloqueiaItens) {
      el.setAttribute('readonly', 'readonly');
      el.classList.add('bg-label-secondary');
      return;
    }

    if (editable) {
      el.removeAttribute('readonly');
      el.classList.remove('bg-label-secondary');
    } else {
      el.setAttribute('readonly', 'readonly');
      el.classList.add('bg-label-secondary');
    }
  });
};

const updateStatusOptionsByTipo = () => {
  if (!tipoEl || !statusEl) return;

  const tipo = tipoEl.value || 'ORCAMENTO';
  const options = statusOptionsByTipo[tipo] || [];
  const selected = statusEl.value;

  statusEl.innerHTML = options
    .map((status) => `<option value="${status}">${status}</option>`)
    .join('');

  if (options.includes(selected)) {
    statusEl.value = selected;
    return;
  }

  if (options.length) {
    statusEl.value = options[0];
  }
};

const bindRowEvents = (row) => {
  row.querySelectorAll('.item-quantidade, .item-preco').forEach((el) => {
    el.addEventListener('input', calcTotals);
    el.addEventListener('change', calcTotals);
  });

  row.querySelector('.remove-item-btn')?.addEventListener('click', () => {
    if (tbody.querySelectorAll('tr[data-row]').length <= 1) {
      row.querySelector('.item-produto-id').value = '';
      row.querySelector('.item-produto-nome').value = '';
      row.querySelector('.item-produto-meta').textContent = '';
      row.querySelector('.item-quantidade').value = '1';
      row.querySelector('.item-preco').value = '0';
      calcTotals();
      return;
    }

    row.remove();
    renumberRows();
    calcTotals();
  });
};

const getRowByProductId = (productId) =>
  [...tbody.querySelectorAll('tr[data-row]')].find((row) => row.querySelector('.item-produto-id').value === String(productId));

const addOrIncrementItem = (produto) => {
  if (bloqueiaItens) return;

  const existingRow = getRowByProductId(produto.id);
  if (existingRow) {
    const qtdEl = existingRow.querySelector('.item-quantidade');
    qtdEl.value = Number(qtdEl.value || 0) + 1;

    if (!allowItemPriceEdit()) {
      existingRow.querySelector('.item-preco').value = Number(produto.preco || 0).toFixed(4);
    }

    calcTotals();
    return;
  }

  const hasBlankRow = [...tbody.querySelectorAll('tr[data-row]')].find((row) => !row.querySelector('.item-produto-id').value);
  const row = hasBlankRow || document.createElement('tr');

  if (!hasBlankRow) {
    const index = tbody.querySelectorAll('tr[data-row]').length;
    row.setAttribute('data-row', '1');
    row.innerHTML = `
      <td>
        <input type="hidden" name="itens[${index}][produto_id]" class="item-produto-id" required>
        <input type="text" class="form-control item-produto-nome" readonly>
        <small class="text-muted item-produto-meta"></small>
      </td>
      <td><input type="number" step="0.001" min="0.001" name="itens[${index}][quantidade]" class="form-control item-quantidade" value="1" required></td>
      <td><input type="number" step="0.0001" min="0" name="itens[${index}][preco_unitario]" class="form-control item-preco" value="0" required></td>
      <td><input type="text" class="form-control item-subtotal" value="R$ 0,00" readonly></td>
      <td><button type="button" class="btn btn-sm btn-outline-danger remove-item-btn">X</button></td>
    `;
    tbody.appendChild(row);
  }

  row.querySelector('.item-produto-id').value = String(produto.id);
  row.querySelector('.item-produto-nome').value = `${produto.nome} (${produto.sku || '-'})`;
  row.querySelector('.item-produto-meta').textContent = `${produto.unidade || 'UN'} • EAN: ${produto.ean || '-'}`;
  row.querySelector('.item-quantidade').value = '1';
  row.querySelector('.item-preco').value = Number(produto.preco || 0).toFixed(4);

  renumberRows();
  bindRowEvents(row);
  updatePriceMode();
  calcTotals();
};

let searchTimeout = null;
const hideResults = () => {
  resultsBox.innerHTML = '';
  resultsBox.style.display = 'none';
};

const renderResults = (items) => {
  if (!items.length) {
    resultsBox.innerHTML = '<div class="list-group-item text-muted">Nenhum produto encontrado.</div>';
    resultsBox.style.display = 'block';
    return;
  }

  resultsBox.innerHTML = items
    .map(
      (p) => `
      <button type="button" class="list-group-item list-group-item-action produto-result-item"
        data-id="${p.id}" data-nome="${(p.nome || '').replace(/"/g, '&quot;')}" data-sku="${(p.sku || '').replace(/"/g, '&quot;')}"
        data-ean="${(p.ean || '').replace(/"/g, '&quot;')}" data-unidade="${(p.unidade || 'UN').replace(/"/g, '&quot;')}" data-preco="${Number(p.preco || 0)}">
        <div class="fw-semibold">${p.nome}</div>
        <small class="text-muted">SKU: ${p.sku || '-'} • EAN: ${p.ean || '-'} • Preco: ${formatCurrency(p.preco)}</small>
      </button>
    `
    )
    .join('');

  resultsBox.style.display = 'block';
};

const fetchProducts = async (term) => {
  if (!searchUrl) return;
  const response = await fetch(`${searchUrl}?termo=${encodeURIComponent(term)}`);
  if (!response.ok) return;
  const data = await response.json();
  renderResults(data.produtos || []);
};

searchInput?.addEventListener('input', () => {
  const term = (searchInput.value || '').trim();
  if (term.length < 2) {
    hideResults();
    return;
  }

  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(() => {
    fetchProducts(term);
  }, 250);
});

resultsBox?.addEventListener('click', (event) => {
  const target = event.target.closest('.produto-result-item');
  if (!target) return;

  addOrIncrementItem({
    id: target.dataset.id,
    nome: target.dataset.nome,
    sku: target.dataset.sku,
    ean: target.dataset.ean,
    unidade: target.dataset.unidade,
    preco: Number(target.dataset.preco || 0),
  });

  searchInput.value = '';
  hideResults();
  searchInput.focus();
});

document.addEventListener('click', (event) => {
  if (resultsBox && !resultsBox.contains(event.target) && event.target !== searchInput) {
    hideResults();
  }
});

let clienteSearchTimeout = null;
const hideClienteResults = () => {
  if (!clienteResultsBox) return;
  clienteResultsBox.innerHTML = '';
  clienteResultsBox.style.display = 'none';
};

const renderClienteResults = (items) => {
  if (!clienteResultsBox) return;
  if (!items.length) {
    clienteResultsBox.innerHTML = '<div class="list-group-item text-muted">Nenhum cliente encontrado.</div>';
    clienteResultsBox.style.display = 'block';
    return;
  }

  clienteResultsBox.innerHTML = items
    .map(
      (c) => `
      <button type="button" class="list-group-item list-group-item-action cliente-result-item"
        data-id="${c.id}" data-nome="${(c.nome || '').replace(/"/g, '&quot;')}"
        data-cpfcnpj="${(c.cpf_cnpj || '').replace(/"/g, '&quot;')}"
        data-tipo="${(c.tipo_cliente || '').replace(/"/g, '&quot;')}"
        data-telefone="${(c.telefone || '').replace(/"/g, '&quot;')}"
        data-email="${(c.email || '').replace(/"/g, '&quot;')}">
        <div class="fw-semibold">${c.nome}</div>
        <small class="text-muted">${c.tipo_cliente || '-'} • ${c.cpf_cnpj || '-'} • ${c.telefone || '-'}</small>
      </button>
    `
    )
    .join('');

  clienteResultsBox.style.display = 'block';
};

const fetchClientes = async (term) => {
  if (!clienteSearchUrl) return;
  try {
    const response = await fetch(`${clienteSearchUrl}?termo=${encodeURIComponent(term)}`);
    if (!response.ok) {
      renderClienteResults([]);
      return;
    }
    const data = await response.json();
    renderClienteResults(data.clientes || []);
  } catch (error) {
    renderClienteResults([]);
  }
};

clienteSearchInput?.addEventListener('input', () => {
  const term = (clienteSearchInput.value || '').trim();
  if (term.length < 2) {
    hideClienteResults();
    return;
  }

  if (clienteIdInput) {
    clienteIdInput.value = '';
  }
  if (clienteMeta) {
    clienteMeta.textContent = '';
  }

  clearTimeout(clienteSearchTimeout);
  clienteSearchTimeout = setTimeout(() => {
    fetchClientes(term);
  }, 250);
});

clienteResultsBox?.addEventListener('click', (event) => {
  const target = event.target.closest('.cliente-result-item');
  if (!target) return;

  if (clienteIdInput) {
    clienteIdInput.value = target.dataset.id || '';
  }
  if (clienteSearchInput) {
    clienteSearchInput.value = target.dataset.nome || '';
  }
  if (clienteMeta) {
    clienteMeta.textContent = `${target.dataset.tipo || '-'} • ${target.dataset.cpfcnpj || '-'} • ${target.dataset.telefone || '-'}`;
  }
  hideClienteResults();
});

document.addEventListener('click', (event) => {
  if (clienteResultsBox && !clienteResultsBox.contains(event.target) && event.target !== clienteSearchInput) {
    hideClienteResults();
  }
});

tipoEl?.addEventListener('change', () => {
  updateStatusOptionsByTipo();
  updatePriceMode();
  calcTotals();
});

document.querySelectorAll('.documento-ajuste').forEach((el) => {
  el.addEventListener('input', calcTotals);
});

[...tbody.querySelectorAll('tr[data-row]')].forEach((row) => {
  bindRowEvents(row);
});

renumberRows();
updateStatusOptionsByTipo();
updatePriceMode();
calcTotals();

document.getElementById('documento-form')?.addEventListener('submit', (event) => {
  if (!clienteIdInput?.value) {
    event.preventDefault();
    alert('Selecione um cliente na busca antes de salvar.');
    clienteSearchInput?.focus();
  }
});

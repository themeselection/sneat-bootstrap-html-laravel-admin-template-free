const produtos = Array.isArray(window.pdvProdutos) ? window.pdvProdutos : [];
const carrinhoTbody = document.querySelector('#pdv-carrinho tbody');
const searchEl = document.getElementById('pdv-search');
const searchResultsEl = document.getElementById('pdv-search-results');
const form = document.getElementById('pdv-form');
const clienteEl = document.getElementById('cliente_id');
const clearBtn = document.getElementById('pdv-clear-cart');

const totalItensEl = document.getElementById('pdv-total-itens');
const totalVolumeEl = document.getElementById('pdv-total-volume');

const cart = new Map();
let highlightedResult = -1;
let visibleResults = [];
let lastAddedProductId = null;

const currency = (v) => `R$ ${Number(v || 0).toFixed(2).replace('.', ',')}`;
const qtyFmt = (v) => Number(v || 0).toFixed(3).replace('.', ',');

const findProducts = (query, limit = 10) => {
  const term = (query || '').trim().toLowerCase();
  if (!term) return [];

  return produtos
    .map((p) => {
      const nome = String(p.nome || '').toLowerCase();
      const sku = String(p.sku || '').toLowerCase();
      const ean = String(p.ean || '').toLowerCase();
      let score = 0;

      if (ean && ean === term) score += 100;
      if (sku && sku === term) score += 90;
      if (nome.startsWith(term)) score += 80;
      if (sku.startsWith(term)) score += 70;
      if (ean.startsWith(term)) score += 60;
      if (nome.includes(term)) score += 50;
      if (sku.includes(term)) score += 40;
      if (ean.includes(term)) score += 30;

      return { produto: p, score };
    })
    .filter((x) => x.score > 0)
    .sort((a, b) => b.score - a.score || String(a.produto.nome).localeCompare(String(b.produto.nome)))
    .slice(0, limit)
    .map((x) => x.produto);
};

const syncTotals = () => {
  const subtotal = [...cart.values()].reduce((acc, item) => acc + item.preco * item.qtd, 0);
  const volume = [...cart.values()].reduce((acc, item) => acc + item.qtd, 0);
  const desconto = Number(document.getElementById('pdv-desconto')?.value || 0);
  const acrescimo = Number(document.getElementById('pdv-acrescimo')?.value || 0);
  const impostos = Number(document.getElementById('pdv-impostos')?.value || 0);
  const total = Math.max(0, subtotal - desconto + acrescimo + impostos);

  const subtotalEl = document.getElementById('pdv-subtotal');
  const totalEl = document.getElementById('pdv-total');
  if (subtotalEl) subtotalEl.textContent = currency(subtotal);
  if (totalEl) totalEl.textContent = currency(total);
  if (totalItensEl) totalItensEl.textContent = String(cart.size);
  if (totalVolumeEl) totalVolumeEl.textContent = qtyFmt(volume);
};

const renderCarrinho = () => {
  carrinhoTbody.innerHTML = '';

  [...cart.values()].forEach((item, index) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        ${item.nome}<br>
        <small class="text-muted">${item.sku || '-'} • Estoque: ${qtyFmt(item.estoque)}</small>
        <input type="hidden" name="itens[${index}][produto_id]" value="${item.id}">
        <input type="hidden" name="itens[${index}][preco_unitario]" value="${Number(item.preco).toFixed(4)}">
      </td>
      <td><input type="number" class="form-control pdv-qtd" min="0.001" step="0.001" value="${item.qtd}" data-id="${item.id}" name="itens[${index}][quantidade]"></td>
      <td>${currency(item.preco)}</td>
      <td>${currency(item.preco * item.qtd)}</td>
      <td><button type="button" class="btn btn-sm btn-outline-danger pdv-remove" data-id="${item.id}">X</button></td>
    `;
    carrinhoTbody.appendChild(tr);
  });

  syncTotals();
};

const addProductToCart = (product) => {
  if (!product) return;
  const key = String(product.id);
  const existing = cart.get(key);
  if (existing) {
    existing.qtd += 1;
  } else {
    cart.set(key, { ...product, qtd: 1 });
  }
  lastAddedProductId = key;
  renderCarrinho();
};

const hideResults = () => {
  if (!searchResultsEl) return;
  searchResultsEl.innerHTML = '';
  searchResultsEl.style.display = 'none';
  visibleResults = [];
  highlightedResult = -1;
};

const highlightResult = (index) => {
  highlightedResult = index;
  if (!searchResultsEl) return;
  const nodes = searchResultsEl.querySelectorAll('.pdv-result-item');
  nodes.forEach((node, i) => {
    if (i === index) {
      node.classList.add('active');
      node.scrollIntoView({ block: 'nearest' });
    } else {
      node.classList.remove('active');
    }
  });
};

const renderResults = (items) => {
  if (!searchResultsEl) return;
  visibleResults = items;
  highlightedResult = items.length ? 0 : -1;

  if (!items.length) {
    searchResultsEl.innerHTML = '<div class="list-group-item text-muted">Nenhum produto encontrado.</div>';
    searchResultsEl.style.display = 'block';
    return;
  }

  searchResultsEl.innerHTML = items
    .map(
      (p, i) => `
      <button type="button" class="list-group-item list-group-item-action pdv-result-item ${i === 0 ? 'active' : ''}" data-id="${p.id}">
        <div class="fw-semibold">${p.nome}</div>
        <small class="text-muted">SKU: ${p.sku || '-'} • EAN: ${p.ean || '-'} • Preço: ${currency(p.preco)} • Estoque: ${qtyFmt(p.estoque)}</small>
      </button>
    `
    )
    .join('');

  searchResultsEl.style.display = 'block';
};

const tryAutoAddExactMatch = (term) => {
  const clean = String(term || '').trim().toLowerCase();
  if (!clean) return false;

  const exact = produtos.find((p) => {
    const ean = String(p.ean || '').toLowerCase();
    const sku = String(p.sku || '').toLowerCase();
    return (ean && ean === clean) || (sku && sku === clean);
  });

  if (!exact) return false;
  addProductToCart(exact);
  return true;
};

const openConferenciaAndSubmit = () => {
  if (cart.size === 0) {
    alert('Adicione pelo menos 1 item no carrinho.');
    return;
  }

  if (!clienteEl?.value) {
    alert('Selecione um cliente antes de finalizar.');
    clienteEl?.focus();
    return;
  }

  const subtotal = [...cart.values()].reduce((acc, item) => acc + item.preco * item.qtd, 0);
  const desconto = Number(document.getElementById('pdv-desconto')?.value || 0);
  const acrescimo = Number(document.getElementById('pdv-acrescimo')?.value || 0);
  const impostos = Number(document.getElementById('pdv-impostos')?.value || 0);
  const total = Math.max(0, subtotal - desconto + acrescimo + impostos);
  const totalQtd = [...cart.values()].reduce((acc, item) => acc + item.qtd, 0);

  const ok = window.confirm(
    `Conferência de fechamento:\n` +
      `Itens distintos: ${cart.size}\n` +
      `Quantidade total: ${qtyFmt(totalQtd)}\n` +
      `Subtotal: ${currency(subtotal)}\n` +
      `Total final: ${currency(total)}\n\n` +
      `Confirma finalizar a venda?`
  );

  if (ok) {
    form?.submit();
  }
};

searchEl?.addEventListener('input', () => {
  const term = searchEl.value || '';
  if (!term.trim()) {
    hideResults();
    return;
  }

  renderResults(findProducts(term));
});

searchEl?.addEventListener('keydown', (event) => {
  const term = searchEl.value || '';

  if (event.key === 'ArrowDown') {
    event.preventDefault();
    if (!visibleResults.length) return;
    highlightResult(Math.min(highlightedResult + 1, visibleResults.length - 1));
    return;
  }

  if (event.key === 'ArrowUp') {
    event.preventDefault();
    if (!visibleResults.length) return;
    highlightResult(Math.max(highlightedResult - 1, 0));
    return;
  }

  if (event.key === 'Escape') {
    hideResults();
    return;
  }

  if (event.key !== 'Enter') return;
  event.preventDefault();

  if (tryAutoAddExactMatch(term)) {
    searchEl.value = '';
    hideResults();
    return;
  }

  const result = visibleResults[highlightedResult] || visibleResults[0] || findProducts(term, 1)[0];
  if (!result) return;
  addProductToCart(result);
  searchEl.value = '';
  hideResults();
});

searchResultsEl?.addEventListener('click', (event) => {
  const btn = event.target.closest('.pdv-result-item');
  if (!btn) return;
  const id = String(btn.getAttribute('data-id'));
  const product = produtos.find((p) => String(p.id) === id);
  addProductToCart(product);
  searchEl.value = '';
  hideResults();
  searchEl.focus();
});

document.addEventListener('click', (event) => {
  if (!searchResultsEl || !searchEl) return;
  if (!searchResultsEl.contains(event.target) && event.target !== searchEl) {
    hideResults();
  }
});

carrinhoTbody?.addEventListener('input', (event) => {
  const target = event.target;
  if (!(target instanceof HTMLInputElement) || !target.classList.contains('pdv-qtd')) return;
  const id = target.dataset.id;
  const item = cart.get(String(id));
  if (!item) return;
  item.qtd = Math.max(0.001, Number(target.value || 0.001));
  renderCarrinho();
});

carrinhoTbody?.addEventListener('click', (event) => {
  const target = event.target;
  if (!(target instanceof HTMLElement) || !target.classList.contains('pdv-remove')) return;
  const id = target.getAttribute('data-id');
  cart.delete(String(id));
  renderCarrinho();
});

['pdv-desconto', 'pdv-acrescimo', 'pdv-impostos'].forEach((id) => {
  document.getElementById(id)?.addEventListener('input', syncTotals);
});

clearBtn?.addEventListener('click', () => {
  if (!cart.size) return;
  if (!window.confirm('Limpar todo o carrinho?')) return;
  cart.clear();
  lastAddedProductId = null;
  renderCarrinho();
  searchEl?.focus();
});

document.addEventListener('keydown', (event) => {
  if (event.target instanceof HTMLInputElement || event.target instanceof HTMLTextAreaElement || event.target instanceof HTMLSelectElement) {
    if (event.key !== 'F2' && event.key !== 'F4' && event.key !== 'F8') {
      return;
    }
  }

  if (event.key === 'F2') {
    event.preventDefault();
    searchEl?.focus();
    searchEl?.select();
    return;
  }

  if (event.key === 'F4') {
    event.preventDefault();
    openConferenciaAndSubmit();
    return;
  }

  if (event.key === 'F8') {
    event.preventDefault();
    clearBtn?.click();
    return;
  }

  if (event.key === 'Backspace' && event.ctrlKey) {
    event.preventDefault();
    if (!lastAddedProductId) return;
    cart.delete(lastAddedProductId);
    renderCarrinho();
  }
});

form?.addEventListener('submit', (event) => {
  event.preventDefault();
  openConferenciaAndSubmit();
});

renderCarrinho();

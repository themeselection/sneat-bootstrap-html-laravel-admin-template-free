<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Itens da Compra</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="compra-itens-table">
                        <thead>
                            <tr>
                                <th style="width: 36%">Produto</th>
                                <th style="width: 12%">Qtd</th>
                                <th style="width: 16%">Preço Unit.</th>
                                <th style="width: 14%">Lote</th>
                                <th style="width: 14%">Validade</th>
                                <th style="width: 8%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-row>
                                <td>
                                    <select class="form-select item-produto" name="itens[0][produto_id]" required>
                                        <option value="">Selecione</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nome }} ({{ $produto->sku }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" class="form-control item-qtd" name="itens[0][quantidade]" min="0.001" step="0.001" value="1" required></td>
                                <td><input type="number" class="form-control item-preco" name="itens[0][preco_unitario]" min="0" step="0.0001" value="0" required></td>
                                <td><input type="text" class="form-control" name="itens[0][numero_lote]"></td>
                                <td><input type="date" class="form-control" name="itens[0][data_validade]"></td>
                                <td><button type="button" class="btn btn-sm btn-outline-danger remove-row">X</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="button" id="add-item-row" class="btn btn-outline-primary btn-sm">Adicionar item</button>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Fornecedor *</label>
                    <select name="fornecedor_id" class="form-select" required>
                        <option value="">Selecione</option>
                        @foreach ($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Filial</label>
                    <select name="filial_id" class="form-select">
                        @foreach ($filiais as $filial)
                            <option value="{{ $filial->id }}">{{ $filial->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data da compra</label>
                    <input type="datetime-local" class="form-control" name="data_compra" value="{{ now()->format('Y-m-d\TH:i') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Vencimento conta a pagar</label>
                    <input type="date" class="form-control" name="vencimento" value="{{ now()->addDays(30)->toDateString() }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="CONFIRMADA">CONFIRMADA</option>
                        <option value="RASCUNHO">RASCUNHO</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea name="observacoes" class="form-control" rows="3"></textarea>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2"><span>Total itens</span><strong id="compra-total-itens">0</strong></div>
                <div class="d-flex justify-content-between"><span>Valor total</span><strong id="compra-total-valor">R$ 0,00</strong></div>
            </div>
        </div>
    </div>
    <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary">Salvar compra</button>
        <a href="{{ route('compras.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</div>

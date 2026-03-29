const tipoPessoaEl = document.getElementById('tipo_pessoa');

if (tipoPessoaEl) {
  const cpfCnpjEl = document.getElementById('cpf_cnpj');
  const btnBuscarCnpj = document.getElementById('btn_buscar_cnpj');
  const labelDocumento = document.getElementById('label_documento');
  const labelNome = document.getElementById('label_nome');
  const labelRgIe = document.getElementById('label_rg_ie');
  const labelData = document.getElementById('label_data');
  const ufEl = document.getElementById('uf');
  const cidadeEl = document.getElementById('cidade');

  const camposPf = document.querySelectorAll('.campo-pf');
  const camposPj = document.querySelectorAll('.campo-pj');

  const onlyDigits = value => (value || '').replace(/\D/g, '');

  const maskCpf = value => value
    .replace(/\D/g, '')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d{1,2})$/, '$1-$2')
    .slice(0, 14);

  const maskCnpj = value => value
    .replace(/\D/g, '')
    .replace(/^(\d{2})(\d)/, '$1.$2')
    .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
    .replace(/\.(\d{3})(\d)/, '.$1/$2')
    .replace(/(\d{4})(\d)/, '$1-$2')
    .slice(0, 18);

  const maskCep = value => value
    .replace(/\D/g, '')
    .replace(/(\d{5})(\d)/, '$1-$2')
    .slice(0, 9);

  const maskPhone = value => {
    const digits = value.replace(/\D/g, '').slice(0, 11);
    if (digits.length <= 10) {
      return digits
        .replace(/(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{4})(\d)/, '$1-$2');
    }
    return digits
      .replace(/(\d{2})(\d)/, '($1) $2')
      .replace(/(\d{5})(\d)/, '$1-$2');
  };

  const updateTipoPessoaUI = () => {
    const isPj = tipoPessoaEl.value === 'PJ';
    labelDocumento.textContent = isPj ? 'CNPJ' : 'CPF';
    labelNome.textContent = isPj ? 'Razao Social' : 'Nome Completo';
    labelRgIe.textContent = isPj ? 'Inscricao Estadual' : 'RG';
    labelData.textContent = isPj ? 'Data de Fundacao' : 'Data de Nascimento';
    btnBuscarCnpj.classList.toggle('d-none', !isPj);
    camposPf.forEach(el => el.classList.toggle('d-none', isPj));
    camposPj.forEach(el => el.classList.toggle('d-none', !isPj));
    cpfCnpjEl.value = isPj ? maskCnpj(cpfCnpjEl.value) : maskCpf(cpfCnpjEl.value);
  };

  const fillInput = (id, value) => {
    if (value === null || value === undefined || value === '') return;
    const el = document.getElementById(id);
    if (el) el.value = value;
  };

  const loadCidades = async (uf, selectedCidade = '') => {
    if (!cidadeEl) return;
    cidadeEl.innerHTML = '<option value="">Carregando...</option>';
    if (!uf) {
      cidadeEl.innerHTML = '<option value="">Selecione</option>';
      return;
    }

    try {
      const response = await fetch(`/clientes/cidades/${uf}`);
      const payload = await response.json();
      const cidades = payload.cidades || [];
      cidadeEl.innerHTML = '<option value="">Selecione</option>';
      cidades.forEach(cidade => {
        const option = document.createElement('option');
        option.value = cidade;
        option.textContent = cidade;
        cidadeEl.appendChild(option);
      });
      if (selectedCidade) {
        const option = Array.from(cidadeEl.options).find(item => item.value === selectedCidade);
        if (!option) {
          const newOption = document.createElement('option');
          newOption.value = selectedCidade;
          newOption.textContent = selectedCidade;
          cidadeEl.appendChild(newOption);
        }
        cidadeEl.value = selectedCidade;
      }
    } catch (error) {
      cidadeEl.innerHTML = '<option value="">Nao foi possivel carregar</option>';
    }
  };

  tipoPessoaEl.addEventListener('change', updateTipoPessoaUI);

  cpfCnpjEl.addEventListener('input', () => {
    cpfCnpjEl.value = tipoPessoaEl.value === 'PJ' ? maskCnpj(cpfCnpjEl.value) : maskCpf(cpfCnpjEl.value);
  });

  document.getElementById('cep')?.addEventListener('input', e => {
    e.target.value = maskCep(e.target.value);
  });

  ['telefone', 'celular'].forEach(fieldId => {
    document.getElementById(fieldId)?.addEventListener('input', e => {
      e.target.value = maskPhone(e.target.value);
    });
  });

  btnBuscarCnpj.addEventListener('click', async () => {
    const cnpj = onlyDigits(cpfCnpjEl.value);
    if (cnpj.length !== 14) {
      alert('Informe um CNPJ valido para consulta.');
      return;
    }

    btnBuscarCnpj.disabled = true;
    btnBuscarCnpj.textContent = 'Buscando...';

    try {
      const response = await fetch(`/clientes/cnpj/${cnpj}`);
      const payload = await response.json();

      if (!response.ok) {
        throw new Error(payload.message || 'Erro ao consultar CNPJ.');
      }

      fillInput('nome', payload.nome);
      fillInput('nome_fantasia', payload.nome_fantasia);
      fillInput('email', payload.email);
      fillInput('telefone', payload.telefone);
      fillInput('cep', maskCep(payload.cep || ''));
      fillInput('logradouro', payload.logradouro);
      fillInput('numero', payload.numero);
      fillInput('complemento', payload.complemento);
      fillInput('bairro', payload.bairro);
      fillInput('codigo_ibge', payload.codigo_ibge);
      fillInput('pais', payload.pais);

      if (payload.uf) {
        ufEl.value = payload.uf;
        await loadCidades(payload.uf, payload.cidade || '');
      }
    } catch (error) {
      alert(error.message || 'Nao foi possivel buscar dados do CNPJ.');
    } finally {
      btnBuscarCnpj.disabled = false;
      btnBuscarCnpj.textContent = 'Buscar CNPJ';
    }
  });

  ufEl.addEventListener('change', e => {
    loadCidades(e.target.value);
  });

  updateTipoPessoaUI();
  if (ufEl.value && cidadeEl.options.length <= 1) {
    const cidadeSelecionada = cidadeEl.value;
    loadCidades(ufEl.value, cidadeSelecionada);
  }
}

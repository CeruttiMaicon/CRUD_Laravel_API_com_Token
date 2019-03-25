

<div class="form-group">
    {{ Form::label('nome_empresa', 'Nome da Empresa') }}
    {{ Form::input('text', 'nome_empresa', null, [
        'placeholder' => 'Nome da Empresa', 
        'class' => 'form-control', 
        'maxlength' => '150', 
        'required' => false,
        'autofocus' => true
        ]) }}
</div>
<div class="form-group">
    {{ Form::label('cnpj', 'CNPJ') }}
    <the-mask 
        value="{{((empty($empresa->cnpj)) ? null : $empresa->cnpj)}}"
        id="cnpj" name="cnpj" placeholder="99.999.999/9999-99" class="form-control" :mask="['##.###.###/####-##']" 
    />
</div>
<div class="form-group">
    {{ Form::label('nome_cidade', 'Nome da Cidade') }}
    {{ Form::input('text', 'nome_cidade', null, [
        'placeholder' => 'Nome da Cidade', 
        'class' => 'form-control', 
        'maxlength' => '150', 
        'required' => false,
        'autofocus' => true
        ]) }}
</div>
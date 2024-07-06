@foreach($produtos as $produto)
<div class="col-sm-6 col-lg-4 all {{ $produto->tipo }}">
  <div class="box">
    <div>
      <div class="img-box">
        <img src="{{ asset('storage/ImagensProdutos/' . $produto->caminhoImagem) }}" alt="{{ $produto->nome }}">
      </div>
      <div class="detail-box">
        <div class="options">
          <div>
            <h6>{{ $produto->nome }}</h6>
            <p>{{ $produto->descricao }}</p>
          </div>
          <div class="d-flex align-items-center">
            <div class="quantity mr-3">
              <input type="number" min="1" value="1" class="form-control form-control-sm">
            </div>
            <a href="#" class="btn add-to-cart" data-id="{{ $produto->id }}" data-nome="{{ $produto->nome }}" data-precoUnitario="{{ number_format($produto->precoUnitario, 2, ',', '.') }}">
              <i class="bi bi-cart" style="color: white;"></i>
              <span class="preco-unitario" style="display: none;">{{ number_format($produto->precoUnitario, 2, ',', '.') }}</span>
            </a>
            <h6>R$ {{ number_format($produto->precoUnitario, 2, ',', '.') }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
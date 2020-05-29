<form class="l-grid">
  @foreach($designs as $design)
    <div class="l-grid__col--3">
      <div class="u-p-4">
        <input type="radio" name="design" class="u-hidden" id="design-{{ $design->id }}" value="{{ $design->id }}" url="{{ base_url('media/design/' . $design->id) }}">
        <label for="design-{{ $design->id }}" class="q-design">
          <div class="q-design__image" style="background-image: url({{ base_url('media/design/' . $design->id) }});"></div>
          <span class="u-uppercase u-font-bold">{{ $design->name }}</span>
        </label>
      </div>
    </div>
  @endforeach
</form>

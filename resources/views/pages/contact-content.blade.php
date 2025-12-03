<ul class="contact_listing">
    <li data-aos="fade-up" data-aos-duration="1500">
        <span class="icon">
            <img src="{{ static_image('mail_icon.png') }}" alt="image">
        </span>
        <span class="lable">Email</span>
        <a href="mailto:{{ $settings->email ?? 'contact@ahla-finance.com' }}">{{ $settings->email ?? 'contact@ahla-finance.com' }}</a>
    </li>
    <li data-aos="fade-up" data-aos-duration="1500" data-aos-delay="150">
        <span class="icon">
            <img src="{{ static_image('phone_icon.png') }}" alt="image">
        </span>
        <span class="lable">Téléphone us</span>
        <a href="tel:{{ $settings->phone ?? '+23561750707' }}">{{ $settings->phone ?? '+235 61 75 07 07' }}</a>
    </li>
    <li data-aos="fade-up" data-aos-duration="1500" data-aos-delay="300">
        <span class="icon">
            <img src="{{ static_image('location_icon.png') }}" alt="image">
        </span>
        <span class="lable">Où sommes nous</span>
        <a target="_blank" href="https://www.google.com/maps">Ouvrir Google Maps</a>
    </li>
</ul>

<!-- Contact Form Section Start -->
<section class="contact_form white_text row_am" data-aos="fade-in" data-aos-duration="1500">
    <div class="contact_inner">
        <div class="container">
            <div class="dotes_blue"><img src="{{ static_image('blue_dotes.png') }}" alt="image"></div>
            <div class="section_title" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="100">
                <span class="title_badge">{{ $page->form_badge ?? 'Écrivez-nous' }}</span>
                <h2>{{ $page->form_title ?? 'Laissez-nous un message' }}</h2>
                <p>{{ $page->form_description ?? 'Remplissez le formulaire ci-dessous, notre équipe vous répondra dans les plus brefs délais.' }}</p>
            </div>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 2rem;">
                    <strong>Succès !</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 2rem;">
                    <strong>Erreur :</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" data-aos="fade-up" data-aos-duration="1500">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nom *" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email *" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Téléphone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Sujet (optionnel)" value="{{ old('subject') }}">
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" placeholder="Votre message *" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="question" class="form-control" placeholder="Posez votre question (optionnel - sera publiée dans la FAQ si pertinente)" rows="3">{{ old('question') }}</textarea>
                            <small class="text-muted">Si vous avez une question que vous souhaitez voir dans la FAQ, remplissez ce champ.</small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="coustome_checkbox">
                            <label for="term_checkbox">
                                <input type="checkbox" id="term_checkbox" name="newsletter" value="1">
                                <span class="checkmark"></span>
                                J'accepte de recevoir des emails, newsletters et messages promotionnels.
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="btn_block">
                            <button type="submit" class="btn puprple_btn ml-0">Envoyer</button>
                            <div class="btn_bottom"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Contact Form Section End -->

<!-- Google Map Start -->
<div class="map_block row_am" data-aos="fade-in" data-aos-duration="1500">
    <div class="container">
        <div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
            @if($settings && $settings->google_maps_url)
                <iframe
                    src="{{ $settings->google_maps_url }}"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Carte Google Maps - Localisation"></iframe>
            @else
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.123456789!2d15.1234567!3d12.1234567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDA3JzI0LjQiTiAxNcKwMDcnMjQuNCJF!5e0!3m2!1sfr!2std!4v1234567890123!5m2!1sfr!2std"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Carte Google Maps - Localisation"></iframe>
            @endif
        </div>
    </div>
</div>
<!-- Google Map End -->


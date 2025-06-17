<div class="row g-3">
    <div class="col-12">
        <h5 class="border-bottom pb-2">Informations sur l'époux</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="nom_epoux" class="form-label">Nom de l'époux <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_epoux') is-invalid @enderror" 
                   id="nom_epoux" name="nom_epoux" value="{{ old('nom_epoux') }}" required>
            @error('nom_epoux')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="prenoms_epoux" class="form-label">Prénoms de l'époux <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('prenoms_epoux') is-invalid @enderror" 
                   id="prenoms_epoux" name="prenoms_epoux" value="{{ old('prenoms_epoux') }}" required>
            @error('prenoms_epoux')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_naissance_epoux" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_naissance_epoux') is-invalid @enderror" 
                   id="date_naissance_epoux" name="date_naissance_epoux" 
                   value="{{ old('date_naissance_epoux') }}" required>
            @error('date_naissance_epoux')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_naissance_epoux" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('lieu_naissance_epoux') is-invalid @enderror" 
                   id="lieu_naissance_epoux" name="lieu_naissance_epoux" 
                   value="{{ old('lieu_naissance_epoux') }}" required>
            @error('lieu_naissance_epoux')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 mt-4">
        <h5 class="border-bottom pb-2">Informations sur l'épouse</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="nom_epouse" class="form-label">Nom de l'épouse <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_epouse') is-invalid @enderror" 
                   id="nom_epouse" name="nom_epouse" value="{{ old('nom_epouse') }}" required>
            @error('nom_epouse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="prenoms_epouse" class="form-label">Prénoms de l'épouse <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('prenoms_epouse') is-invalid @enderror" 
                   id="prenoms_epouse" name="prenoms_epouse" value="{{ old('prenoms_epouse') }}" required>
            @error('prenoms_epouse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_naissance_epouse" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_naissance_epouse') is-invalid @enderror" 
                   id="date_naissance_epouse" name="date_naissance_epouse" 
                   value="{{ old('date_naissance_epouse') }}" required>
            @error('date_naissance_epouse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_naissance_epouse" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('lieu_naissance_epouse') is-invalid @enderror" 
                   id="lieu_naissance_epouse" name="lieu_naissance_epouse" 
                   value="{{ old('lieu_naissance_epouse') }}" required>
            @error('lieu_naissance_epouse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 mt-4">
        <h5 class="border-bottom pb-2">Informations sur le mariage</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_mariage" class="form-label">Date du mariage <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" 
                   id="date_mariage" name="date_mariage" value="{{ old('date_mariage') }}" required>
            @error('date_mariage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_mariage" class="form-label">Lieu du mariage <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('lieu_mariage') is-invalid @enderror" 
                   id="lieu_mariage" name="lieu_mariage" value="{{ old('lieu_mariage') }}" required>
            @error('lieu_mariage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
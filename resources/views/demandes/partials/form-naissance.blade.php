<div class="row g-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nom_enfant" class="form-label">Nom de l'enfant <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_enfant') is-invalid @enderror" 
                   id="nom_enfant" name="nom_enfant" value="{{ old('nom_enfant') }}" required>
            @error('nom_enfant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="prenoms_enfant" class="form-label">Prénoms de l'enfant <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('prenoms_enfant') is-invalid @enderror" 
                   id="prenoms_enfant" name="prenoms_enfant" value="{{ old('prenoms_enfant') }}" required>
            @error('prenoms_enfant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_naissance_enfant" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_naissance_enfant') is-invalid @enderror" 
                   id="date_naissance_enfant" name="date_naissance_enfant" 
                   value="{{ old('date_naissance_enfant') }}" required>
            @error('date_naissance_enfant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_naissance_enfant" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('lieu_naissance_enfant') is-invalid @enderror" 
                   id="lieu_naissance_enfant" name="lieu_naissance_enfant" 
                   value="{{ old('lieu_naissance_enfant') }}" required>
            @error('lieu_naissance_enfant')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 mt-3">
        <h5 class="border-bottom pb-2">Informations sur le père</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="nom_pere" class="form-label">Nom du père <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_pere') is-invalid @enderror" 
                   id="nom_pere" name="nom_pere" value="{{ old('nom_pere') }}" required>
            @error('nom_pere')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="prenoms_pere" class="form-label">Prénoms du père <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('prenoms_pere') is-invalid @enderror" 
                   id="prenoms_pere" name="prenoms_pere" value="{{ old('prenoms_pere') }}" required>
            @error('prenoms_pere')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 mt-3">
        <h5 class="border-bottom pb-2">Informations sur la mère</h5>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="nom_mere" class="form-label">Nom de la mère <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_mere') is-invalid @enderror" 
                   id="nom_mere" name="nom_mere" value="{{ old('nom_mere') }}" required>
            @error('nom_mere')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="prenoms_mere" class="form-label">Prénoms de la mère <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('prenoms_mere') is-invalid @enderror" 
                   id="prenoms_mere" name="prenoms_mere" value="{{ old('prenoms_mere') }}" required>
            @error('prenoms_mere')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
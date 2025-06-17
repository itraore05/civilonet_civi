<div class="row g-3">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nom_defunt" class="form-label">Nom du défunt <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nom_defunt') is-invalid @enderror" 
                   id="nom_defunt" name="nom_defunt" value="{{ old('nom_defunt') }}" required>
            @error('nom_defunt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="prenoms_defunt" class="form-label">Prénoms du défunt <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('prenoms_defunt') is-invalid @enderror" 
                   id="prenoms_defunt" name="prenoms_defunt" value="{{ old('prenoms_defunt') }}" required>
            @error('prenoms_defunt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_naissance_defunt" class="form-label">Date de naissance <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_naissance_defunt') is-invalid @enderror" 
                   id="date_naissance_defunt" name="date_naissance_defunt" 
                   value="{{ old('date_naissance_defunt') }}" required>
            @error('date_naissance_defunt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_naissance_defunt" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('lieu_naissance_defunt') is-invalid @enderror" 
                   id="lieu_naissance_defunt" name="lieu_naissance_defunt" 
                   value="{{ old('lieu_naissance_defunt') }}" required>
            @error('lieu_naissance_defunt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="date_deces" class="form-label">Date du décès <span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('date_deces') is-invalid @enderror" 
                   id="date_deces" name="date_deces" value="{{ old('date_deces') }}" required>
            @error('date_deces')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="lieu_deces" class="form-label">Lieu du décès <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('lieu_deces') is-invalid @enderror" 
                   id="lieu_deces" name="lieu_deces" value="{{ old('lieu_deces') }}" required>
            @error('lieu_deces')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
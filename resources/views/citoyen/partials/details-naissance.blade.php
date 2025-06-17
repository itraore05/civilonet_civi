<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th width="30%">Nom de l'enfant</th>
                <td>{{ $demande->acteNaissance->nom_enfant }}</td>
            </tr>
            <tr>
                <th>Prénoms de l'enfant</th>
                <td>{{ $demande->acteNaissance->prenoms_enfant }}</td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ \Carbon\Carbon::parse($demande->acteNaissance->date_naissance_enfant)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lieu de naissance</th>
                <td>{{ $demande->acteNaissance->lieu_naissance_enfant }}</td>
            </tr>
            <tr>
                <th>Nom du père</th>
                <td>{{ $demande->acteNaissance->nom_pere }}</td>
            </tr>
            <tr>
                <th>Prénoms du père</th>
                <td>{{ $demande->acteNaissance->prenoms_pere }}</td>
            </tr>
            <tr>
                <th>Nom de la mère</th>
                <td>{{ $demande->acteNaissance->nom_mere }}</td>
            </tr>
            <tr>
                <th>Prénoms de la mère</th>
                <td>{{ $demande->acteNaissance->prenoms_mere }}</td>
            </tr>
        </tbody>
    </table>
</div>
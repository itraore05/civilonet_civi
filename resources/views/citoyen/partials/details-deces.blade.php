<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th width="30%">Nom du défunt</th>
                <td>{{ $demande->acteDeces->nom_defunt }}</td>
            </tr>
            <tr>
                <th>Prénoms du défunt</th>
                <td>{{ $demande->acteDeces->prenoms_defunt }}</td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ \Carbon\Carbon::parse($demande->acteDeces->date_naissance_defunt)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lieu de naissance</th>
                <td>{{ $demande->acteDeces->lieu_naissance_defunt }}</td>
            </tr>
            <tr>
                <th>Date du décès</th>
                <td>{{ \Carbon\Carbon::parse($demande->acteDeces->date_deces)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lieu du décès</th>
                <td>{{ $demande->acteDeces->lieu_deces }}</td>
            </tr>
        </tbody>
    </table>
</div>

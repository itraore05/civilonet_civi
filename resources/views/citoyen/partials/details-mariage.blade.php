<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th width="30%">Nom de l'époux</th>
                <td>{{ $demande->acteMariage->nom_epoux }}</td>
            </tr>
            <tr>
                <th>Prénoms de l'époux</th>
                <td>{{ $demande->acteMariage->prenoms_epoux }}</td>
            </tr>
            <tr>
                <th>Date de naissance de l'époux</th>
                <td>{{ \Carbon\Carbon::parse($demande->acteMariage->date_naissance_epoux)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lieu de naissance de l'époux</th>
                <td>{{ $demande->acteMariage->lieu_naissance_epoux }}</td>
            </tr>
            <tr>
                <th>Nom de l'épouse</th>
                <td>{{ $demande->acteMariage->nom_epouse }}</td>
            </tr>
            <tr>
                <th>Prénoms de l'épouse</th>
                <td>{{ $demande->acteMariage->prenoms_epouse }}</td>
            </tr>
            <tr>
                <th>Date de naissance de l'épouse</th>
                <td>{{ \Carbon\Carbon::parse($demande->acteMariage->date_naissance_epouse)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lieu de naissance de l'épouse</th>
                <td>{{ $demande->acteMariage->lieu_naissance_epouse }}</td>
            </tr>
            <tr>
                <th>Date du mariage</th>
                <td>{{ \Carbon\Carbon::parse($demande->acteMariage->date_mariage)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lieu du mariage</th>
                <td>{{ $demande->acteMariage->lieu_mariage }}</td>
            </tr>
        </tbody>
    </table>
</div>
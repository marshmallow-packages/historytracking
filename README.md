<p align="center">
    <img src="https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png">
</p>
<p align="center">
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/issues/Marshmallow-Development/package-historytracking.svg" alt="Issues">
    </a>
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/forks/Marshmallow-Development/package-historytracking.svg" alt="Forks">
    </a>
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/stars/Marshmallow-Development/package-historytracking.svg" alt="Stars">
    </a>
    <a href="https://github.com/Marshmallow-Development">
        <img src="https://img.shields.io/github/license/Marshmallow-Development/package-historytracking.svg" alt="License">
    </a>
</p>

# Marshmallow History Tracker
Log alle wijzigingen die in een model gedaan worden door een trait toe te voegen aan de models waar je dit van wilt bijhouden.

### Installatie
```
composer require marshmallow/package-historytracking
```

Als composer klaar is, zorg dan dat je de benodigde tabellen aanmaakt.

```
php artisan migrate
```

Om gebruik te maken van `HistoryTracking` voeg je de traits `Historyable` toe aan de model waar je de wijzigingen wilt bijhouden.

```
namespace App;
use Illuminate\Database\Eloquent\Model;
use Marshmallow\HistoryTracking\Traits\Historyable;

class User extends Model
{
    use Historyable;
}
```

### Niet alle kolomen bijhouden
Als je bepaalde kolommen niet wilt bijhouden in de history tabel zoals bijvoorbeeld het wachtwoord veld van een gebruiker, dan kan je die met onderstaande functie meegeven. Let op dat als je deze method implementeerd je de default method overschrijft. Die default sluit de kolom `updated_at` uit. Als je deze method overschrijf, vergeet dan niet die kolom ook altijd toe te voegen.

```
class User extends Model
{
    use Historyable;

    ...

    public function ignoreHistoryColumns ()
    {
        return [
            'password',
            'updated_at'
        ];
    }
}
```

- - -

Copyright (c) 2020 marshmallow
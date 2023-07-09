ActorCMS
=======

ActorCMS je jednoduchý obsahový správce (CMS) navržený speciálně pro potřeby herců a tvůrců, kteří chtějí vytvořit své vlastní online portfolio. S ActorCMS můžete snadno vytvořit a spravovat své herecké příspěvky, zobrazit svůj demoreel, sdílet informace o svých projektech, vystoupeních a dovednostech.

Funkce
-------
- Jednoduchá správa příspěvků: Přidávejte, upravujte a odstraňujte příspěvky pro zobrazení na vašem portfoliu.
- Podpora demoreelů: Nahrajte a zobrazte svůj demoreel včetně videí ze svých nejlepších vystoupení a projektů.
- Stránky o vás: Vytvořte si vlastní stránky, kde můžete sdílet svou biografii, fotky, kontaktní informace a další.
- Nastavení vzhledu: Přizpůsobte si vzhled svého portfolia pomocí vlastních barev, loga, ikon a fontů.
- Dynamická navigace: Upravujte navigaci na svém portfoliu přidáváním, upravováním nebo odebíráním položek.
- Přizpůsobitelné URL adresy: Každý příspěvek a stránka má vlastní přátelskou URL adresu pro snadný přístup.

Instalace
-------
1. Stáhněte si nejnovější verzi ActorCMS z tohoto repozitáře.
2. Rozbalte stažený soubor a nahrajte obsah do kořenového adresáře vašeho webového serveru.
3. Vytvořte prázdnou databázi pro ActorCMS.
4. Zkopírujte soubor `.env.example` a pojmenujte jej jako `.env`. Upravte soubor `.env` a nastavte připojení k vaší databázi.
5. Spusťte příkaz `composer install` a `php artisan key:generate` pro instalaci závislostí a vygenerování unikátního klíče aplikace.
6. Spusťte příkaz `php artisan migrate` pro vytvoření potřebných tabulek v databázi.
7. Nastavte správná oprávnění pro potřebné adresáře a soubory (např. `storage` a `bootstrap/cache`).

Po dokončení těchto kroků by měla být instalace ActorCMS hotová a můžete začít s vytvářením svého hereckého portfolia.

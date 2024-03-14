# Volební aplikace ŽOP

## User stories

| Fáze | Jako | Chci | Poznámky | Hotovo |
|------|------|------|----------|--------|
| Před zahájením voleb | Technický správce | Nasadit aplikaci na hosting | | |
| | | Nastavit parametry aplikace | Proměnné prostředí v `.env` | |
| Po celou dobu voleb | Technický správce | Mít přístup k logům aplikace | | |
| | | Mít přístup k databázi | | |
| | | Zadat administrátora aplikace | | |
| | Administrátor | Přihlásit se do administrativní aplikace | | :tada: |
| | | Přidat člena volebního týmu | | :tada: |
| | | Aktivovat/deaktivovat člena volebního týmu | | |
| | | Nahrát voliče (kódy a členská čísla) | | :tada: |
| | | Aktivovat/deaktivovat voliče | | :tada: |
| | | Přepínat fáze voleb | | :tada: |
| | | Prohlížet aplikační auditlog se záznamem akcí | | |
| Příprava | Člen volebního týmu | Přihlásit se do administrativní aplikace | | :tada: |
| | | Vytvořit/editovat/smazat kandidáta | | :tada: |
| | | Vytvořit/editovat/smazat kandidátní listinu | | :tada: |
| | | Přidat/odebrat kandidáta z kandidátní listiny | | :tada: |
| | Administrátor | Vygenerovat QR kódy pro kódy voliče | | |
| Elektronické hlasování | Volič | Přihlásit se do volební aplikace | | :tada:|
| | | Zobrazit kandidátní listiny a kandidáty | | :tada: |
| | | Hlasovat (vybrat kandidáty a odeslat hlasování) | | :tada: |
| | | Zobrazit své uložené hlasování | | :tada: |
| Zpracování listinného hlasování | Člen volebního týmu | Zadávat kódy voliče z listinného hlasování klávesnící | | |
| | | Zadávat kódy voliče z listinného hlasování čtečkou kódů | | |
| Po korespondenčním, před prezenčním hlasováním | Administrátor | Získat seznam kódů voličů (a jestli hlasovali) | | |
| Zpracování výsledků hlasování | Administrátor | Získat souhrnné výsledky elektronického hlasování | | |
| Po ukončení voleb | Technický správce | Zlikvidovat instanci volební aplikace | | |

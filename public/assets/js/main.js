/**
 * Funkce pro administraci
 */
class AdminPanel {
    /**
     * Vytvoří slug pro příspěvek z jeho názvu
     * @param {string} input_title Vstupní pole názvu příspěvku
     * @param {string} input_slug Vstupní pole slugu příspěvku
     */
    createPostSlug(input_title, input_slug) {
        var nazev = input_title.value;
        var slug = "";

        var nazevPole = nazev.toLowerCase().split('');
        var novyNazev = "";

        for(var i = 0; i < nazevPole.length; i++) {
            switch(nazevPole[i]) {
                case ' ':
                    nazevPole[i] = '-';
                    break;
                case 'á':
                    nazevPole[i] = 'a';
                    break;
                case 'č':
                    nazevPole[i] = 'c';
                    break;
                case 'ď':
                    nazevPole[i] = 'd';
                    break;
                case 'ě':
                case 'é':
                    nazevPole[i] = 'e';
                    break;
                case 'í':
                    nazevPole[i] = 'i';
                    break;
                case 'ň':
                    nazevPole[i] = 'n';
                    break;
                case 'ó':
                    nazevPole[i] = 'o';
                    break;
                case 'ř':
                    nazevPole[i] = 'r';
                    break;
                case 'š':
                    nazevPole[i] = 's';
                    break;
                case 'ú':
                case 'ů':
                    nazevPole[i] = 'u';
                    break;
                case 'ý':
                    nazevPole[i] = 'y';
                    break;
                case 'ž':
                    nazevPole[i] = 'z';
                    break;
                default:
                    nazevPole[i] = nazevPole[i];
                    break;
            }

            novyNazev += nazevPole[i];
        }

        slug = `${novyNazev}`;
        this.updatePostSlug(input_slug, slug);
    }

    /**
     * Změní dynamicky slug příspěvku ve vstupu formuláře
     * @param {input} input_slug Vstupní pole slugu příspěvku
     * @param {string} value Hodnota nového slugu
     */
    updatePostSlug(input_slug, value) {
        input_slug.value = value;
    }
}

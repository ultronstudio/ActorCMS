@extends('layouts.admin.panel')
@section('title', 'Nová stránka')
@section('content')
    <div class="row mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3>Nová stránka</h3>
            </div>
        </div>
        <hr>
        <div class="">
            <form method="POST" action="{{ url('/admin/stranka/nova') }}" id="formular-nova_stranka"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nazev" class="form-label">Název</label>
                    <input type="text" id="stranka_nazev" name="title" class="form-control" required oninput="adminPanel.createPostSlug(document.getElementById('stranka_nazev'), document.getElementById('stranka_slug'))">
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="stranka_slug" name="slug" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Obsah</label>
                    <textarea name="content" id="obsah" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Vytvořit</button>
                </div>
            </form>
            <script>
                tinymce.init({
                    selector: '#obsah',
                    language: 'cs',
                    resize: false,
                    browser_spellcheck: true,
                    branding: false,
                    menubar: 'edit view tools mytemplates',
                    menu: {
                        edit: {
                            title: 'Upravit',
                            items: 'undo redo selectall'
                        },
                        view: {
                            title: 'Zobrazit',
                            items: 'code'
                        },
                        tools: {
                            title: 'Nástroje',
                            items: 'preview searchreplace'
                        },
                        mytemplates: {
                            title: 'Šablony',
                            items: 'template_dej template_film template_serial'
                        }
                    },
                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | link image media',
                    plugins: [
                        'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                        'searchreplace', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                        'insertdatetime',
                        'media', 'table', 'emoticons', 'template', 'help'
                    ],
                    templates: [],
                    setup: function(editor) {
                        editor.ui.registry.addIcon('livetv',
                            '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m383-350 267-170-267-170v340Zm-53 230v-80H140q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h680q24 0 42 18t18 42v520q0 24-18 42t-42 18H630v80H330ZM140-260h680v-520H140v520Zm0 0v-520 520Z"/></svg>'
                        );

                        editor.ui.registry.addIcon('timeline',
                            '<svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M109.912-240Q81-240 60.5-260.589 40-281.177 40-310.089 40-339 60.494-359.5t49.273-20.5q5.233 0 10.233.5 5 .5 13 2.5l200-200q-2-8-2.5-13t-.5-10.233q0-28.779 20.589-49.273Q371.177-670 400.089-670 429-670 449.5-649.366t20.5 49.61Q470-598 467-577l110 110q8-2 13-2.5t10-.5q5 0 10 .5t13 2.5l160-160q-2-8-2.5-13t-.5-10.233q0-28.779 20.589-49.273Q821.177-720 850.089-720 879-720 899.5-699.411q20.5 20.588 20.5 49.5Q920-621 899.506-600.5T850.233-580Q845-580 840-580.5q-5-.5-13-2.5L667-423q2 8 2.5 13t.5 10.233q0 28.779-20.589 49.273Q628.823-330 599.911-330 571-330 550.5-350.494T530-399.767q0-5.233.5-10.233.5-5 2.5-13L423-533q-8 2-13 2.5t-10.25.5q-1.75 0-22.75-3L177-333q2 8 2.5 13t.5 10.233q0 28.779-20.589 49.273Q138.823-240 109.912-240Z"/></svg>'
                        );

                        editor.ui.registry.addIcon('person',
                            '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>'
                        );

                        var selectElement = document.getElementById('prispevek_typ');

                        var template_dej = {
                            title: 'Děj',
                            description: 'Popis děje filmu, seriálu nebo divadelního představení.',
                            content: '<h3>Děj:</h3>' +
                                '<p>[POPIS DĚJE]</p>'
                        };

                        var template_serial = {
                            title: 'Seznam epizod a sérií',
                            description: 'Seznam epizod a sérií seriálu. Tato šablona vám umožňuje snadno vytvořit seznam epizod a sérií s hierarchií. Každá série obsahuje seznam tří epizod.',
                            content: '<ul>' +
                                '<li>Série 1<ul><li>Epizoda 1</li><li>Epizoda 2</li><li>Epizoda 3</li></ul></li>' +
                                '<li>Série 2<ul><li>Epizoda 1</li><li>Epizoda 2</li><li>Epizoda 3</li></ul></li>' +
                                '<li>Série 3<ul><li>Epizoda 1</li><li>Epizoda 2</li><li>Epizoda 3</li></ul></li>' +
                                '</ul>'
                        };

                        var template_film = {
                            title: 'Obsazení filmu',
                            description: 'Informace o obsazení filmu. Tato šablona vám umožňuje snadno vytvořit seznam osobností spojených s filmem.',
                            content: '<h3>Herci:</h3>' +
                                '<ul>' +
                                '<li>[JMÉNO HERCE 1] (<b>[ROLE HERCE 1]</b>)</li>' +
                                '<li>[JMÉNO HERCE 2] (<b>[ROLE HERCE 2]</b>)</li>' +
                                '<li>[JMÉNO HERCE 3] (<b>[ROLE HERCE 3]</b>)</li>' +
                                '</ul>' +
                                '<h3>Hlavní tvůrčí a organizační pracovníci výrobního štábu:</h3>' +
                                '<ul>' +
                                '<li>Režie: [JMÉNO REŽISÉRA]</li>' +
                                '<li>Scénář: [JMÉNO SCÉNÁRISTY]</li>' +
                                '<li>Hlavní kameraman: [JMÉNO HLAVNÍHO KAMERAMANA]</li>' +
                                '<li>Architekt: [JMÉNO ARCHITEKTA]</li>' +
                                '<li>Mistr zvuku: [JMÉNO MISTRA ZVUKU]</li>' +
                                '<li>Střihač: [JMÉNO STŘIHAČE]</li>' +
                                '<li>Masky: [JMÉNO MASKÉRA]</li>' +
                                '<li>Hudba: [JMÉNO HUDEBNÍHO SKLADATELE]</li>' +
                                '<li>Kostýmy: [JMÉNO NÁVRHÁŘE KOSTÝMŮ]</li>' +
                                '</ul>'
                        };

                        editor.ui.registry.addMenuItem('template_serial', {
                            icon: 'livetv',
                            text: 'Seznam epizod a sérií seriálu',
                            onAction: function() {
                                if (selectElement.value === 'serial') {
                                    editor.insertContent(template_serial.content);
                                }
                            },
                            onSetup: function(buttonApi) {
                                buttonApi.setDisabled(selectElement.value !== 'serial');
                                selectElement.addEventListener('change', function() {
                                    buttonApi.setDisabled(selectElement.value !== 'serial');
                                });
                            }
                        });

                        editor.ui.registry.addMenuItem('template_film', {
                            text: 'Obsazení filmu',
                            icon: 'person',
                            onAction: function() {
                                editor.insertContent(template_film.content);
                            }
                        });

                        editor.ui.registry.addMenuItem('template_dej', {
                            text: 'Děj',
                            icon: 'timeline',
                            onAction: function() {
                                editor.insertContent(template_dej.content);
                            }
                        });
                    }
                });
            </script>
        </div>
    </div>
@endsection

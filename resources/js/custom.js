document.addEventListener("DOMContentLoaded", function () {


    // Toggle menu on mobile

    const menu_groups = document.getElementsByClassName('menu-group')
    const toggle_button = document.getElementById('toggle')
    if (toggle_button !== null) {
        toggle_button.addEventListener('click', () => {
            for (let group of menu_groups) {
                group.classList.toggle('menu-open')
            }
        })
    }

    // toggle card infos
    const toggle_infos = document.getElementsByClassName('action-toggle')
    if (toggle_infos !== null) {
        for (let btn of toggle_infos) {
            btn.addEventListener('click', () => {
                btn.classList.toggle('rotate-180')
                btn.parentNode.parentNode.parentNode.getElementsByClassName('infos')[0].classList.toggle('expand')
            })
        }

    }

    /*
    * Managing show / hide list items details
    * the code bellow is linked to .trigger-part .hidden-part  classes
    * wrap the trigger part in a .trigger-part class and the part to hide / show in .hidden-part
    *
     */

    const triggers = document.getElementsByClassName('trigger-part');
    if (triggers) {
        for (trigger of triggers) {
            trigger.addEventListener('click', function (e) {
                var next = e.target.parentNode.nextElementSibling;
                if (next.style.maxHeight && next.style.maxHeight !== '0px') {
                    next.style.maxHeight = '0'
                    e.target.parentNode.style.backgroundColor = 'rgba(255, 255, 255, 1)';
                } else {
                    e.target.parentNode.style.backgroundColor = 'rgba(206, 206, 206, .18)';
                    next.style.maxHeight = '5rem';
                }
            })
        }
    }

    /**
     *
     * Managing the display of the client details from de selected choice
     */
    var select = document.getElementById('select-client');
    var infos = document.getElementById('show-client-infos');
    if (select) {
        select.addEventListener('change', function () {
            if (this.value > -1) {
                fetch('/api/client/' + this.value)
                    .then(response => {
                        if (response.ok) {

                            return response;
                        } else throw Error('Pas de client');

                    })
                    .then(response => {
                        response.text().then(function (text) {
                            infos.innerHTML=""
                            const content = JSON.parse(text)
                            let clientUrl = document.getElementById('showClient')
                            let href = clientUrl.href
                            let splitted = href.split("/")
                            let newId = splitted[splitted.length-1]
                            let currentId = String(content.id)
                            href = href.replace(newId, currentId)
                            clientUrl.href = href
                            const location = document.createElement('p');
                            location.innerHTML += content.company;
                            location.innerHTML += '<br />';
                            location.innerHTML += content.firstname + ' ' + content.lastname + '<br />'
                            location.innerHTML += content.street + ' ' + content.nr + '<br />'
                            // location.innerHTML += content.city.code + ' ' + content.city.city
                            // infos.append(location)

                            const contact = document.createElement('p');
                            contact.innerHTML += 'TVA: ' + content.vat + '<br />'
                            contact.innerHTML += 'Email: ' + content.email + '<br />'
                            contact.innerHTML += 'Phone: ' + content.phone
                            infos.append(location)
                            infos.append(contact)
                        })
                    })
                    .catch(error => {
                        console.log(error)
                        infos.innerText = ''
                    })
            } else {
                infos.innerText = ''
            }
        });

    }

    /**
     * Add an Item row in my form
     */

    const row_container = document.getElementById('items');
    const row = document.getElementsByClassName('item-row')[0];
    var add_buttons = ''
    const remove_buttons = document.getElementsByClassName('remove-item');
    var i = 0;
    // console.log(add_buttons)
    setAddButtons()
    hidePlus()
    listenItems()

    function listenItems() {
        document.getElementById('items').addEventListener('click', function (e) {

            if (e.target.classList.contains('remove-item')) {
                let parent = document.getElementById('items');
                parent.removeChild(e.target.parentNode.parentNode.parentNode)
                hideFirstMinus()
                setAddButtons()
                // listenItems()
                hidePlus()
                // i--;
            }
            if (e.target.classList.contains('add-item')) {
                i++;
                document.getElementsByClassName('remove-item')[0].style.display = "flex"
                let new_row = document.createElement('div');
                new_row.classList.add('table-data-row');
                new_row.innerHTML += `
                            <div class="form-row w-full md:w-1/3">
                                <input type="text" id="description[]"
                                       name="items[${i}][description]"
                                       class="form-control"
                                       value=""
                                />
                            </div>
                            <div class="middle">
                             <div class="form-row w-16 md:w-16">
                                <input type="text"
                                       name="items[${i}][price]"
                                       class="form-control"
                                       value=""
                                />
                            </div>
                            <div class="form-row w-16 md:w-16">
                                <input type="number"
                                       min="1"
                                       name="items[${i}][qty]"
                                       class="form-control"
                                       value="1"
                                />
                            </div>
                            <div class="form-row w-16 md:w-16">
                                <select class="custom-select" 
                                        name="items[${i}][vat_id]">
                                        <option value="1" >6 % </option>
                                        <option value="2" >12 % </option>
                                        <option value="3" >21 % </option>
                                </select>
                            </div>
                        </div>
                            <div class="right">
                            <div class="form-row w-16 md:w-16">
                                <input name="items[${i}][discount]"
                                       type="text"
                                       value=""
                                       class="form-control"
                                />
                            </div>
                       
                            <div class="form-row w-24 justify-between" style="flex-direction: row">
                                <button type="button"
                                        class="button danger  remove-item">
                                        <i class="fa fa-minus" style="pointer-events:none"></i>
                                </button>
                                <button type="button"
                                        class="button success add-item ">
                                        <i class="fa fa-plus" style="pointer-events:none"></i>
                                </button>
                            </div>
                    `
                row_container.append(new_row);
                hidePlus()
            }
        })
    }

    function setAddButtons() {
        add_buttons = document.getElementsByClassName('add-item');
    }

    function hidePlus() {
        let length = add_buttons.length
        console.log(length)
        if (add_buttons.length > 1) {
            for (let i = 0; i < add_buttons.length - 1; i++) {
                add_buttons[i].style.display = "none"
            }
            add_buttons[length-1].style.display = "flex"
        } else {
            add_buttons[0].style.display = "flex"
        }
    }

    function hideFirstMinus(){
        let remove_buttons = document.getElementsByClassName('remove-item');
        if (remove_buttons.length === 1) {
            remove_buttons[0].style.display = "none"
        }
    }

})
;

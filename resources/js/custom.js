
document.addEventListener("DOMContentLoaded", function () {
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
                            const content = JSON.parse(text)
                            console.log(content)
                            const location = document.createElement('p');
                            location.innerHTML += content.company;
                            location.innerHTML += '<br />';
                            location.innerHTML += content.firstname + ' ' + content.lastname + '<br />'
                            location.innerHTML += content.street + ' ' + content.nr + '<br />'
                            location.innerHTML += content.city.code + ' ' + content.city.city
                            infos.append(location)

                            const contact = document.createElement('p');
                            contact.innerHTML += 'TVA: ' + content.vat + '<br />'
                            contact.innerHTML += 'Email: ' + content.email + '<br />'
                            contact.innerHTML += 'Phone: ' + content.phone
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
    const add_buttons = document.getElementsByClassName('add-item');
    const remove_buttons = document.getElementsByClassName('remove-item');
    var i = 0;
    // console.log(add_buttons)

    document.getElementById('items').addEventListener('click', function (e) {

        if (e.target.classList.contains('remove-item')) {
            let parent = document.getElementById('items');
            parent.removeChild(e.target.parentNode.parentNode)
            // i--;
        }
        if (e.target.classList.contains('add-item')) {
            i++;
            let new_row = document.createElement('div');
            new_row.classList.add('row');
            new_row.classList.add('item-row');
            new_row.innerHTML += `
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="description[]"
                                       name="items[${i}]['description']"
                                       class="form-control"
                                       value=""
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text"
                                       name="items[${i}]['price']"
                                       class="form-control"
                                       value=""
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="custom-select" 
                                        name="items[${i}]['vat']">
                                        <option value="0.06" >6 % </option>
                                        <option value="0.12" >12 % </option>
                                        <option value="0.21" >21 % </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <input type="text"
                                       name="items[${i}]['qty']"
                                       class="form-control"
                                       value=""
                                />
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <input name="items[${i}]['discount']"
                                       type="text"
                                       value=""
                                       class="form-control"
                                />
                            </div>
                        </div>
                        <div class="col-md-2" style="align-items: center">
                            <button type="button"
                                    class="btn btn-danger remove-item">
                                <i class="fa fa-minus" style="pointer-events:none"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-primary add-item">
                                <i class="fa fa-plus" style="pointer-events:none"></i>
                            </button>
                    </div>
`
            row_container.append(new_row);
        }
    })

// for (let btn of remove_buttons) {
//     btn.addEventListener('click', function (e) {
//         console.log(e)
//         if(e.target != 'svg') {
//             console.log(e)
//             console.log(e.target.parentNode.parentNode)
//             let parent = document.getElementById('items');
//             console.log(this);
//             parent.removeChild(e.target.parentNode.parentNode)
//         }
//     })
// }
// for (let btn of add_buttons) {
//     btn.addEventListener('click', function (e) {
//         let new_row = document.createElement('div');
//         new_row.classList.add('row');
//         new_row.classList.add('item-row');
//         new_row.innerHTML += ` <div class="col-md-6">
//                         <div class="form-group">
//                             <label for="description[]">Description</label>
//                             <input type="text" id="description[]" name="description" class="form-control"/>
//                         </div>
//                     </div>
//                     <div class="col-md-1">
//                         <div class="form-group">
//                             <label for="qty[]">Qty</label>
//                             <input type="text" name="qty[]" class="form-control"/>
//                         </div>
//                     </div>
//                     <div class="col-md-1">
//                         <div class="form-group">
//                             <label for="discount[]" class="control-label">Reduc</label>
//                             <input name="discount[]" type="text" value="" class="form-control">
//                         </div>
//                     </div>
//                     <div class="col-md-2" style="align-items: center">
//                         <button type="button"
//                                 class="btn btn-danger remove-item">
//                             <i class="fa fa-minus" style="pointer-events:none"></i>
//                         </button>
//                         <button type="button"
//                                 class="btn btn-primary add-item">
//                             <i class="fa fa-plus"></i>
//                         </button>
//                      </div>
// `
//         row_container.append(new_row);
//     })
// }


})
;

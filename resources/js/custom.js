document.addEventListener("DOMContentLoaded", function() {

    /**
     *
     * Managing the display of the client details from de selected choice
     */
   var select = document.getElementById('select-client');
   var infos = document.getElementById('show-client-infos');
   select.addEventListener('change', function() {
      if(this.value>-1) {
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

    /**
     * Add an Item row in my form
     */

    const row_container = document.getElementById('items');
    const row = document.getElementsByClassName('item-row')[0];
    const add_buttons = document.getElementsByClassName('add-item');
    // console.log(add_buttons)

    for (let btn of add_buttons) {

        btn.addEventListener('click', function (e) {

            let new_row = document.createElement('div');
            new_row.classList.add('row');
            new_row.classList.add('item-row');
            new_row.innerHTML += ` <div class="col-md-6">
                        <div class="form-group">
                            <label for="description[]">Description</label>
                            <input type="text" id="description[]" name="description" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="qty[]">Qty</label>
                            <input type="text" name="qty[]" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="discount[]" class="control-label">Reduc</label>
                            <input name="discount[]" type="text" value="" class="form-control">
                        </div>
                    </div>`
            row_container.append(new_row);
      })
    }
});

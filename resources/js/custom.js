document.addEventListener("DOMContentLoaded", function() {
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
});

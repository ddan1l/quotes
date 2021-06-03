(async function (){
    const codeSelect = document.querySelector('#code');
    (await getCurrencies()).forEach(currency => {
        const option = document.createElement('option');
        option.value = currency['currency_id'];
        option.innerHTML = currency.name;
        codeSelect.appendChild(option)
    })
   codeSelect.addEventListener('change', getQuotes)
   NiceSelect.bind(codeSelect, {
       searchable: true,
       placeholder: 'Выберите валюту',
       selectFirst: true,
   });

    const picker = new Lightpick({
        field: document.getElementById('date'),
        singleDate: false,
        maxDays: 30,
        lang: 'ru',
        maxDate: new Date(),
        locale: {
            tooltip: {
                one: 'день',
                few: 'дня',
                many: 'дней',
            },
            pluralize: function(i, locale) {
                if ('one' in locale && i % 10 === 1 && !(i % 100 === 11)) return locale.one;
                if ('few' in locale && i % 10 === Math.floor(i % 10) && i % 10 >= 2 && i % 10 <= 4 && !(i % 100 >= 12 && i % 100 <= 14)) return locale.few;
                if ('many' in locale && (i % 10 === 0 || i % 10 === Math.floor(i % 10) && i % 10 >= 5 && i % 10 <= 9 || i % 100 === Math.floor(i % 100) && i % 100 >= 11 && i % 100 <= 14)) return locale.many;
                if ('other' in locale) return locale.other;
                return '';
            }
        },
        onSelect: async function(){
            await getQuotes()
        }
    });

    picker.setDateRange(new Date(), new Date())

   async function getQuotes(){
      const code = codeSelect.selectedOptions[0].value.trim()
      const from =  picker.getStartDate().format(' YYYY-MM-DD').toString().trim()
      const to =  picker.getEndDate().format(' YYYY-MM-DD').toString().trim()
      const response = await fetch(`quote/getExchanges/${code}/${from}/${to}`, {
           method: 'GET'
      })

      fillTable(await response.json())
   }

   function fillTable(quotes){
       const wrapper = document.querySelector('.quotes__wrapper')
       wrapper.innerHTML = ''
       quotes.forEach(quote => {
           wrapper.innerHTML+=`
           <tr>
               <th scope="row">${quote.name}</th>
               <td>${quote.nominal}</td>
               <td>${quote['char_code']}</td>
               <td>${quote.value}</td>
               <td>${quote.date}</td>
           </tr>
           `
       })

       console.log()
   }
   async function getCurrencies(){
       const response = await fetch('/quote/getCurrencies/', {
           method: 'GET'
       })
       return await response.json()
   }
})()
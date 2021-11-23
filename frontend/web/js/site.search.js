$('#loginform-username').select2({
    ajax: {
        url: '/ajax/index-search',
        data: function (params) {
            return {
                q: params.term
            };
        },
        dataType: 'json'
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    },
    minimumInputLength: 3,
    formatInputTooShort: function(term, minLength){
        return 'Сўз 3 та ҳарфдан кўп бўлиши керак';
    },
    placeholder: 'Қидириш',
    formatSearching: 'Қидириш...',
    formatNoMatches: 'Топилмади'
});
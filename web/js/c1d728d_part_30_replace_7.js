smartApp.filter("string.replace", [ function(){
    return function(str, pattern, replacement){
        try {
            return (str || '').replace(pattern,replacement);
        } catch(e) {
            console.error("error in string.replace", e);
            return (str || '');
        }
    }
}
]);
$(document).ready(
function (){
        $('.delete').Delete();
});

$.fn.Delete = function() {
        
        this.click(function (event){
                
                event.preventDefault();
                
                var answer = confirm("Delete Gallery?")
                if (answer)
                {
                    window.location = this.href;
                    return true;
                }
                    
                return false;
                
        });
                
};
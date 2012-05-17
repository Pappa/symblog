$(document).ready(
function (){
        $('.attachG').Picker();
        $('.attachI').Picker();
});

$.fn.Picker = function() {
        
        
        
        this.click(function (event){
                
                event.preventDefault();
                
                b = $('#blogger_blogbundle_blogtype_blog');
                
                ar = this.id.split('-');
                
                t = '';
                
                if(this.title) {
                        t = ' title="'+this.title+'"';
                }
                
                b.val(b.val()+'[['+ar[0]+'="'+ar[1]+'"'+t+']]');
                
                return true;
                
        });
        
        return true;
        
};
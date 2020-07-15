const comment_check = () =>{
  let comment = $("#comment").val();
  var result = confirm("｢" + comment + "｣　この内容でよろしいですか？");
  if( result == true ) {
  }
  else {
    return false;
  }
}
const delete_check = () =>{
  let result = confirm("本当に削除しますか？");
  if( result ) {
    
  }else {
    return false;
  }
}

function randomString() {
	var chars = "abcdefghiklmnopqrstuvwxyz";
	var string_length = 4;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}


function verifyDeleteSecured(){
var validationString = randomString();
var rnum = Math.floor(Math.random() * validationString.length) + 1;
var promptString = 'Are you sure? For security, please type character ' + (rnum) + ' of ' + validationString + ' into the box provided.';
return prompt(promptString) == validationString.substring(rnum-1,rnum);
}



$(document).ready(function () {
	DisplayVisits();
	OffDialog();
	tooltip();
	getSessionStorage()  
	
});

$(function ()
{
	$('#menu > li:nth-child(2) > a > span').click(
		function ()
		{
		$('#menu > li:nth-child(2) > ul').fadeToggle(500);
		})
})

function setBackground(color) {
	document.body.style.backgroundColor = color;
	
	if (window.localStorage) {
	if (localStorage.color) {
		localStorage.color = color;
	}}
}	

function quiz() {
	var result = 0;
	var answers = ['a', 'c']
	if (document.querySelector('.quiz1:checked').value == answers[0]) result++;
	if (document.querySelector('.quiz2:checked').value == answers[1]) result++;
	
	var text = document.createTextNode('Wynik to ' + result + ' ptk.');
	var div = document.getElementById('dialog');
	if ($("#dialog").text() != "") {
		$("#dialog").empty();
	}
	div.appendChild(text);
	$(function () {
		$("#dialog").dialog('open');        
	})   
	
}

function showAnswer() {
	var p = document.getElementById('show');
	var node = document.createElement("H2"); 
	var h2 = document.createTextNode('Pytanie 1 - S50, Pytanie 2 - Stuhl.');
	node.appendChild(h2); 
	document.getElementById('show').appendChild(node);  
	 
	$('#continueButton').attr("disabled", true);
}

function temp()
{
	if (window.sessionStorage) {
	var checkbox = $.map($('input[name="simson"]:checked'), function (c) { return c.value; })
	var point = $.map($('input[name="points"]:checked'), function (c) { return c.value; })
	sessionStorage.setItem('name', $('#name').val());
	sessionStorage.setItem('surname', $('#surname').val());
	sessionStorage.setItem('email', $('#email').val());
	sessionStorage.setItem('question', $('#question').val());
	sessionStorage.setItem('simson', checkbox);
	sessionStorage.setItem('points', point);
	sessionStorage.setItem('active', true);
	}
	
}

function DisplayVisits() {
	if (window.localStorage) {
	if (localStorage.color) {
		document.body.style.backgroundColor = localStorage.color;
	}
	else {
		document.body.style.backgroundColor = 'white';
		localStorage.color = 'white';
	}
	}
};
function OffDialog() {
	$(function () {
		$("#dialog").dialog({
			autoOpen: false,
			height: 100,
			width: 200,
		});
	})
};
function tooltip() {
	$('[title]').tooltip();

};
function getSessionStorage() {
if (window.sessionStorage) {
	if (sessionStorage.getItem('active')) {
		var name = sessionStorage.getItem('name');
		var surname = sessionStorage.getItem('surname');
		var email = sessionStorage.getItem('email');
		var question = sessionStorage.getItem('question');
		var simson = sessionStorage.getItem('simson');
		var points = sessionStorage.getItem('points');
		try {
			var array = simson.split(',');
			array.forEach(function (element) {
				$('input[value=' + element + ']').prop("checked", true);
			});
		}
		catch(err){}
		$("#name").val(name);
		$("#surname").val(surname);
		$("#email").val(email);
		$("#question").val(question);
		$('input[value=' + points + ']').prop("checked", true);
	}
} 
};
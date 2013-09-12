
var mashContainer;
var mashSvc = 'mash.php';
var speed = 500;

$(document).ready(function($)
{
	mashContainer = $('#mashContainer');
	if (mashContainer.length > 0)
	{
		loadNextMash().show();
		loadNextMash();
	}
});

function loadNextMash()
{
	var nextMash = document.createElement('div');
	nextMash.className = 'oneMash';
	nextMash.innerHTML = 'Loading...';
	mashContainer.append(nextMash);
	return $(nextMash).hide().load(mashSvc, 'get', newMashLoaded);
}

function newMashLoaded(responseText, textStatus, XMLHttpRequest)
{
	var myDiv = $(this);
	var cands = myDiv.find('.candidate');
	cands[0].mashDiv = this;
	cands[1].mashDiv = this;
	cands.click(candidateClicked);
}

function candidateClicked(eventObject)
{
	var $mash = $(this.mashDiv);
	$mash.find('.candidate').unbind('click');
	$mash.slideUp(speed, harakiri);
	$mash.next().fadeIn(speed);
	applyVote(this.attributes.mashmyvote.value);
	loadNextMash();
}

function applyVote(vote)
{
	$.get(mashSvc, 'put-'+vote);
}

function harakiri() { $(this).detach(); }


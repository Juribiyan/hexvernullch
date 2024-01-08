
// Fisher–Yates shuffle of cells: https://stackoverflow.com/a/11972692/1561204
async function shuffle() {
	const container = getActiveLayer()
	const allChans = container._$$('.chan-cell')
	for (var i = allChans.length; i >= 0; i--) {
	  container.appendChild(allChans[Math.random() * i | 0]);
	}
}

function getActiveLayer() {
	return $('#offline-toggle').checked ? $('#chans-offline') : $('#chans-online')
}

function searchFilter(q) {
	const visibleCells = getActiveLayer()
	const invisibleCells = $('#invisible-cells')
	$$('.chan-cell').forEach(ch => {
		const found = ~ch.dataset.search.indexOf(q.toLowerCase())
		if (found /*&& invisibleCells.contains(ch)*/) {
			visibleCells.appendChild(ch)
		}
		if (!found && visibleCells.contains(ch)) {
			invisibleCells.appendChild(ch)
		}
	})
}

function resetSearch() {
	const offline = $('#chans-offline')
	const online = $('#chans-online')
	$$('.chan-cell').forEach(ch => {
		if (ch.dataset.offline == 1) {
			offline.appendChild(ch)
		}
		else {
			online.appendChild(ch)
		}
	})
}

function setupSearch() {
	const $i = $('#search-form input')
	$i.addEventListener('input', function() {
		searchFilter(this.value)
	})
	
	$('#search-form').addEventListener('submit', ev => ev.preventDefault())
	
	$('#search-state-on').addEventListener('change', function() {
		if (this.checked) {
			$i.focus()
		}
		else {
			$i.value = ''
			resetSearch()
		}
	})
}

function main() {
	$('#c-shuffle').addEventListener('click', (ev) => {
		ev.preventDefault()
		shuffle()
	})
	
	setupSearch()
}
let maxR = 10

function hexNumber(n) {
  return 6 * ((n + 1) / 2) * n
}

let sideIncrements = [
  {x: 0.5, y: 1}, // [/  ]
  {x: 1,   y: 0}, // [ — ]
  {x: 0.5, y:-1}, // [  \]
  {x:-0.5, y:-1}, // [  /]
  {x:-1,   y: 0}, // [ _ ]
  {x:-0.5, y: 1}  // [\  ]
]

let orderedCells = []

for (let i = 0; i <= hexNumber(maxR); i++) {
  if (i == 0) {
    orderedCells.push({x: 0, y: 0})
    continue;
  }
  let c = Math.floor(0.5 + Math.sqrt(4 * i - 1)/(2 * Math.sqrt(3))) // circle# = #cells@side
  let cc = i - hexNumber(c-1) - 1 // cell#@circle
  let s = Math.floor(cc / c) // side#
  let sc = cc % c // cell#@side
  let xy = {x: -c, y: 0}

  for (z in xy) {
    for (let si = 0; si <= 5; si++) {
      if (s > si) {
        xy[z] += sideIncrements[si][z] * c
      }
      if (s == si) {
        xy[z] += sideIncrements[si][z] * sc
      }
    }
  }
  orderedCells.push({x: xy.x, y: xy.y})
}

function distance(c) {
  return c.x**2 + c.y**2
}

let distanceSorted = orderedCells.sort((a, b) => distance(a) - distance(b))

let crds = {x: {}, y: {}}
;['x', 'y'].forEach(z => {
  distanceSorted.forEach((c, i) => {
    if (! (c[z] in crds[z])) {
      crds[z][c[z]] = []
    }
    crds[z][c[z]].push(i)
  })
})

let css = ``

;['x', 'y'].forEach(z => {
  for (pos in crds[z]) {
    let cells = crds[z][pos]
    let val = z=='x'
      ? `left:calc(${pos} * var(--w))`
      : `top:calc(${pos} * var(--h)); --z-off:${pos}`
    css += cells.map(c => `.cell:nth-child(${c+1})`).join(',') + `{${val}}\n`
  }
})

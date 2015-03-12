var counter = 0;

function incrementCounter() {
	counter = counter + 1;
	return counter;
}

function isolatedCounter() {
	var counter = 0;
	counter = counter + 1;
	return counter;
}

console.log('Счетчик:', incrementCounter());
console.log('Счетчик:', incrementCounter());
console.log('Счетчик:', incrementCounter());
console.log('Изолированный счетчик, который не работает:', isolatedCounter());
console.log('Изолированный счетчик, который не работает:', isolatedCounter());
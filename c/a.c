#include <stdio.h>

int test(char *a) {
	printf("hola %s, y hola", a);
}

int main() {
	test("pepe");
	printf(" mundo\n");
	return 0;
}

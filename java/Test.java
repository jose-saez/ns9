class Test {

	class Animal {
			String nombre;
	}

	class Gato extends Animal {
			public void ronronear() {
					System.out.println("rrrrrrr....");
			}
	}

	public static void main(String[] args) {
			Test t = new Test();
			t.prueba();
	}
	
	public void prueba() {
			System.out.println("Probando...");
			Animal a;
			Gato b;
			a = new Animal();
			b = (Gato) a;
			System.out.println("Adiós...");
	}
}

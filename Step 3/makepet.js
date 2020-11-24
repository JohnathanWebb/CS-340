
window.onload = function() {
	var PetModal = document.getElementById("PetModal");
	var PetButton = document.getElementById("AddPetButton");
	var PetForm = document.getElementById("NewPet");

	PetButton.onclick = function() {
		PetModal.style.display = "block";
		PetForm.style.display = "block";
	}
	window.onclick = function(event) {
		if(event.target == PetModal) {
			PetModal.style.display = "none";
			PetForm.style.display = "none";
		}
	}
	
}
const listDoctors = document.querySelector('.medlink_content_doctors_list_items');
document.querySelector('.medlink_content_doctors_list_prev')?.addEventListener('click', () => listDoctors.scrollBy({ left: -240, behavior: 'smooth' }));
document.querySelector('.medlink_content_doctors_list_next')?.addEventListener('click', () => listDoctors.scrollBy({ left: 240, behavior: 'smooth' }));

const listPhamacy = document.querySelector('.medlink_content_pharmacy_list');
document.querySelector('.medlink_content_pharmacy_nav_prev')?.addEventListener('click', () => listPhamacy.scrollBy({ left: -240, behavior: 'smooth' }));
document.querySelector('.medlink_content_pharmacy_nav_next')?.addEventListener('click', () => listPhamacy.scrollBy({ left: 240, behavior: 'smooth' }));

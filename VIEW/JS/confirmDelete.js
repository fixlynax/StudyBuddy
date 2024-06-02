function confirmDelete(studySubjectID) {
  if (confirm("Are you sure you want to delete this subject?")) {
    window.location.href = `deleteSubjectHandler.php?id=${studySubjectID}`;
  }
}

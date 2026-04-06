export function convertDate (dt, frmt) {
  const date = new Date (dt);
  return date.toLocaleDateString ('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });
}

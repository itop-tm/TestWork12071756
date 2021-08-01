export default function({ store, redirect, app }) {
  if (!store.getters['user/getToken']) {
    return redirect(app.$lp('/auth/sign-in'))
  }
}

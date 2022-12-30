/** --------------------------------
 * URLのパラメータの値を取得する
 *
 * @param key
 */
function get_param(key) {
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	return urlParams.get(key)
}

/** --------------------------------
 * URLのパラメータの値を配列で取得する
 *
 * @param key
 */
function get_params(key) {
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);

	return urlParams.getAll(key)
}

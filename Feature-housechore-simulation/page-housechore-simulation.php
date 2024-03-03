<?php

/**
 * Template Name: 家事当番シミュレーション
 * @package WordPress
 * @Template Post Type: post, page,
 * @subpackage Vanilla
 */
get_header(); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tsukimi+Rounded:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<main class="pageHousechoreSimulation">
	<div class="inner">


		<div class="pageHousechoreSimulationContent -jouge-sauu-center">

			<!-- 初期画面 -->
			<article class="pageHousechoreSimulationFirst -box  -jouge-sauu-center" id="step0">
				<h1 class="pageHousechoreSimulation__mainTitle -comic">Hibarihiruzu Housechore Simulator </h1>

				<button type="button" id="startButton" onclick="transition('/step1'), init_roulette()" class="pageHousechoreSimulation__button">家事を決める</button><br>
				<button type="button" id="resetButton" onclick="reset_session_storage()" class="pageHousechoreSimulation__button -reset">リセット</button>
			</article>

			<!-- ルーレット画面 -->
			<article class="pageHousechoreSimulationRoulette  -display-none" id="step1">
				<div class="pageHousechoreSimulationRoulette__content -box -jouge-sauu-center-absolute">
					<h2 class="pageHousechoreSimulation__mainTitle -comic">今週の「<span class="targetHousechoreName">ゴミ出し</span>」担当を決める</h2>

					<ul class="pageHousechoreSimulationRoulette__pList" Id="pageHousechoreSimulationRoulettePlayerList">
						<li class="pageHousechoreSimulationRoulette__player" id="player1">
							<p class="pageHousechoreSimulationRoulette__playerName">翔太</p>
							<p class="pageHousechoreSimulationRoulette__playerAka">（aka. 実質、神。）</p>
						</li>
						<li class="pageHousechoreSimulationRoulette__player" id="player2">
							<p class="pageHousechoreSimulationRoulette__playerName">スピードスター</p>
							<p class="pageHousechoreSimulationRoulette__playerAka">（aka. くしゃみが「あっふぅんにゅぅ♡」）</p>
						</li>
						<li class="pageHousechoreSimulationRoulette__player" id="player3">
							<p class="pageHousechoreSimulationRoulette__playerName">GUCCI</p>
							<p class="pageHousechoreSimulationRoulette__playerAka">（aka. GUCCI）</p>
						</li>
						<li class="pageHousechoreSimulationRoulette__player" id="player4">
							<p class="pageHousechoreSimulationRoulette__playerName">大分一の脛かじり</p>
							<p class="pageHousechoreSimulationRoulette__playerAka">（aka. 俺に齧れない脛はない）</p>
						</li>
					</ul>

					<br><br>

					<button type="button" id="startRoulette" class="pageHousechoreSimulation__button" onclick="start_roulette_animation()">れっつすぴんっ!!</button>
					<button type="button" id="toResult" class="pageHousechoreSimulation__button -display-none" onclick="transition('/step2'), play_video()">結果画面へ</button>

					<audio src="<?php echo get_template_directory_uri() . '/Image/housechore-simulation/audio_roulette_slowly_stops_1.mp3' ?>" id="AudioRoulette"></audio>
					<audio src="<?php echo get_template_directory_uri() . '/Image/housechore-simulation/audio_roulette_end_1.mp3' ?>" id="AudioRouletteEnd"></audio>

				</div>
			</article>


			<!-- 結果画面 -->
			<article class="pageHousechoreSimulationResult -display-none  " id="step2">
				<div class="-jouge-sauu-center-absolute  -box">
					<h2 class="pageHousechoreSimulation__mainTitle -comic">
						今週の「<span class="targetHousechoreName">ゴミ出し</span>」担当は...
					</h2>

					<p class="pageHousechoreSimulationResult__selectedPlayer" id="pageHousechoreSimulationResultSelectedPlayer"></p>

					<figure class="pageHousechoreSimulationResult__figure">
						<video src="" class="pageHousechoreSimulationResult__video"></video>
					</figure>
					<br>
					<br>

					<button type="button" id="backToStep1" class="pageHousechoreSimulation__button" onclick="back_to_step1()">家事選択画面へ</button>
					<button type="button" id="showWorstResult" class="pageHousechoreSimulation__button -display-none" onclick="show_worst_result()">最下位発表</button>
					<button type="button" id="toSummary" class="pageHousechoreSimulation__button -display-none" onclick="transition('/step3'), to_summary()">結果画面へ</button>
				</div>
			</article>

			<!-- 結果一覧 -->
			<article class="pageHousechoreSimulationSummary -box -display-none" id="step3">
				<ul class="pageHousechoreSimulationSummary__list">
					<li class="pageHousechoreSimulationSummary__item">
						<div class="pageHousechoreSimulationSummary__itemGrd"></div>
						<p class="pageHousechoreSimulationSummary__playerChore"></p>
						<p class="pageHousechoreSimulationSummary__playerName"></p>
						<p class="pageHousechoreSimulationSummary__playerAka"></p>
						<figure class="pageHousechoreSimulationSummary__figure">
							<video src="<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore1_video.mp4" class="pageHousechoreSimulationSummary__video"></video>
						</figure>
					</li>
					<li class="pageHousechoreSimulationSummary__item">
						<div class="pageHousechoreSimulationSummary__itemGrd"></div>
						<p class="pageHousechoreSimulationSummary__playerChore"></p>
						<p class="pageHousechoreSimulationSummary__playerName"></p>
						<p class="pageHousechoreSimulationSummary__playerAka"></p>
						<figure class="pageHousechoreSimulationSummary__figure">
							<video src="<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore2_video.mp4" class="pageHousechoreSimulationSummary__video"></video>
						</figure>
					</li>
					<li class="pageHousechoreSimulationSummary__item">
						<div class="pageHousechoreSimulationSummary__itemGrd"></div>
						<p class="pageHousechoreSimulationSummary__playerChore"></p>
						<p class="pageHousechoreSimulationSummary__playerName"></p>
						<p class="pageHousechoreSimulationSummary__playerAka"></p>
						<figure class="pageHousechoreSimulationSummary__figure">
							<video src="<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore3_video.mp4" class="pageHousechoreSimulationSummary__video"></video>
						</figure>
					</li>
					<li class="pageHousechoreSimulationSummary__item">
						<div class="pageHousechoreSimulationSummary__itemGrd"></div>
						<p class="pageHousechoreSimulationSummary__playerChore"></p>
						<p class="pageHousechoreSimulationSummary__playerName"></p>
						<p class="pageHousechoreSimulationSummary__playerAka"></p>
						<figure class="pageHousechoreSimulationSummary__figure">
							<video src="<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore4_video.mp4" class="pageHousechoreSimulationSummary__video"></video>
						</figure>
					</li>
				</ul>
			</article>

		</div>

	</div>
</main>




<script>
	let home_url = "<?php echo home_url("/housechore-simulation/"); ?>";
	let housechore_order = [
		"chore3",
		"chore2",
		"chore1",
		"chore4",
	]

	let housechore_data_array = {
		"chore1": {
			'name': '何もしない',
			'movie': '<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore1_video.mp4',
		},
		"chore2": {
			'name': '掃除',
			'movie': '<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore2_video.mp4',
		},
		"chore3": {
			'name': 'ゴミ出し',
			'movie': '<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore3_video.mp4',
		},
		"chore4": {
			'name': '皿洗い',
			'movie': '<?php echo get_template_directory_uri()  ?>/Image/housechore-simulation/chore4_video.mp4',
		},
	};

	let players_object = {
		"player1": {
			'name': '翔太',
			'aka': '実質、神。',
		},
		"player2": {
			'name': 'スピードスター',
			'aka': 'くしゃみが「あっふぅんにゅぅ♡」',
		},
		"player3": {
			'name': 'GUCCI',
			'aka': 'GUCCI',
		},
		"player4": {
			'name': '大分一の脛かじり',
			'aka': '俺に齧れない脛はない',
		},
	};

	function get_result_object() {
		let ss_result_json = window.sessionStorage.getItem('ss_result_json')
		// let ss_result_json = '{"chore3":"player4","chore2":"player2","chore1":"player1"}'
		// let ss_result_json = '{"chore3":"player4","chore2":"player2"}'
		return (ss_result_json) ? JSON.parse(ss_result_json) : {}
	}

	function get_result_object_keys() {
		let result_object_keys = Object.keys(get_result_object());
		return result_object_keys
	}

	function get_result_object_values() {
		let result_object_values = Object.values(get_result_object());
		return result_object_values
	}

	let ss_selected_player = window.sessionStorage.getItem('ss_selected_player')



	/** --------------------------------
	 *
	 *
	 * @param
	 */

	function get_last_url_path() {
		//= 現在のページのURLを取得 ====
		const url = new URL(window.location.href);
		//= URLのパス部分を '/' で分割し、空の文字列を除外する ====
		const path_segments = url.pathname.split('/').filter(segment => segment !== '');
		//= 最後のパスセグメントを取得 ====
		return path_segments.pop();
	}

	/** --------------------------------
	 *
	 *
	 * @param
	 */

	function section_fade() {

		//= 変数定義 ====
		let duration = 500
		const last_path = get_last_url_path()

		//= fade in するセクションを判定 ====
		if (last_path.includes("step")) {
			fade_in_section = $('#' + last_path)
		} else {
			fade_in_section = $('#step0')
		}

		//= fade in実行 ====
		$('article').fadeOut(duration)
		setTimeout(function() {
			fade_in_section.fadeIn(duration)
		}, duration);
	}

	/** --------------------------------
	 *
	 *
	 * @param
	 */

	function transition(new_path) {
		//= 変数定義 ====
		const current_url = new URL(home_url);
		const new_url = current_url + new_path;

		//= ブラウザの履歴に新しいURLを追加し、アドレスバーを更新 ====
		window.history.pushState({
			path: new_url
		}, '', new_url);

		//= セクション切り替え ====
		section_fade()
	}

	/** --------------------------------
	 * sessionStorageのリセット
	 */
	function reset_session_storage() {
		sessionStorage.clear();
		$('.pageHousechoreSimulationRoulette__player').removeClass('-determined')
	}

	function get_player_object(player_id) {
		return players_object[player_id]
	}

	function init_roulette() {
		//---------------------
		// これから選択する家事を決める
		//---------------------
		let current_chore = ''
		if (get_result_object_keys().length > 0) {
			let difference = housechore_order.filter(x => !get_result_object_keys().includes(x)).concat(get_result_object_keys().filter(x => !housechore_order.includes(x)));
			current_chore = difference[0]
		} else {
			current_chore = housechore_order[0]
		}

		if (current_chore) {
			window.sessionStorage.setItem('ss_current_chore', current_chore)
		} else {
			window.sessionStorage.setItem('ss_current_chore', '')
		}


		let current_chore_name = housechore_data_array[current_chore].name
		$('.targetHousechoreName').text(current_chore_name)

		//---------------------
		// ルーレット開始前に全愛のルーレットで選択されたことがあるプレーヤーに-determinedクラスを付与する
		//---------------------
		let players = $('.pageHousechoreSimulationRoulette__player');
		players.each(function() {
			$(this).removeClass('-grd-animation -selected')
			let player_id = $(this).attr('id')
			let player_id_selected = get_result_object_values().includes(player_id);

			if (player_id_selected) {
				let player_object = get_player_object(player_id)
				$(this).addClass('-determined')
				let selected_player_chore = Object.keys(get_result_object()).find(key => get_result_object()[key] === player_id);
				let selected_player_chore_name = housechore_data_array[selected_player_chore].name
				let selected_player_name = `<p class="pageHousechoreSimulationRoulette__playerName">${selected_player_chore_name} : ${player_object.name}</p>` +
					'<p class="pageHousechoreSimulationRoulette__playerAka">（aka. ' + player_object.aka + '）</p>'

				$(this).html(selected_player_name)
			}
		})
	}

	/** --------------------------------
	 * ルーレットアニメーション
	 */
	function start_roulette_animation() {

		// AudioContextの初期化
		const audioContext = new AudioContext();

		// オーディオファイルを読み込む
		fetch('<?php echo get_template_directory_uri() . "/Image/housechore-simulation/audio_roulette_slowly_stops_1.mp3" ?>')
			.then(response => response.arrayBuffer())
			.then(arrayBuffer => audioContext.decodeAudioData(arrayBuffer))
			.then(audioBuffer => {
				// オーディオバッファからデータを取得
				let source = audioContext.createBufferSource();
				source.buffer = audioBuffer;

				// オーディオの解析
				let analyser = audioContext.createAnalyser();
				source.connect(analyser);
				analyser.fftSize = 256;
				let bufferLength = analyser.frequencyBinCount;
				let dataArray = new Uint8Array(bufferLength);

				// オーディオが終了したときのイベントハンドラを設定
				source.onended = function() {
					end_of_audio();
				};

				// ルーレットアニメーションの関数
				function rouletteAnimation() {
					requestAnimationFrame(rouletteAnimation);
					analyser.getByteFrequencyData(dataArray);

					// 閾値を超えたかチェック
					let maxVolume = Math.max(...dataArray);
					if (maxVolume > 208.4) { // 閾値は調整が必要
						// ルーレットアニメーションを更新
						updateRoulette();
					}
				}

				// アニメーションを開始
				rouletteAnimation();

				// オーディオを接続して再生
				source.connect(audioContext.destination);
				source.start();
			});
	}

	// ルーレットを更新する関数（ここは既存の関数に置き換える）
	function updateRoulette() {
		let players = $('.pageHousechoreSimulationRoulette__player:not(.-determined)');
		let randomIndex = Math.floor(Math.random() * players.length); // ランダムなインデックスを生成
		players.removeClass('-selected'); // 選択されているプレイヤーから-selectedクラスを削除
		$(players[randomIndex]).addClass('-selected'); // ランダムに選ばれたプレイヤーに-selectedクラスを追加
	}

	function play_video() {
		let video = $('.pageHousechoreSimulationResult__video').get(0)
		video.play()
	}

	function pause_video() {
		let video = $('.pageHousechoreSimulationResult__video').get(0)
		video.pause()
	}

	/** --------------------------------
	 * オーディオの再生が終了した後に呼び出される関数
	 *
	 */
	function end_of_audio() {
		setTimeout(function() {
			//= resultを取得 ====
			let result = get_result_object()

			//= 最後に一回ルーレットを挟む ====
			updateRoulette();

			//= 最後の音源を再生 ====
			let audio = document.getElementById('AudioRouletteEnd'); // <audio>エレメントを取得
			audio.play();

			//= 選ばれたプレイやーにグラデーションを付与 ====
			let selected_player_element = $('.pageHousechoreSimulationRoulette__player.-selected')
			selected_player_element.addClass('-grd-animation')


			//= selected_playerを挿入 ====
			let selected_player = selected_player_element.attr('id')
			window.sessionStorage.setItem('ss_selected_player', selected_player)

			//= resultを挿入 ====
			let ss_current_chore = window.sessionStorage.getItem('ss_current_chore')
			result[ss_current_chore] = selected_player
			let result_json = JSON.stringify(result)
			console.log(result)
			window.sessionStorage.setItem('ss_result_json', result_json)

			//= 選択されたプレイヤーを記述 ====
			$('#targetHousechoreName').text(housechore_data_array[ss_current_chore].name)

			//= 選択されたプレイヤーを記述 ====
			$('#pageHousechoreSimulationResultSelectedPlayer').html(selected_player_element.html())

			//= 選択された動画を挿入 ====
			$('.pageHousechoreSimulationResult__video').attr('src', housechore_data_array[ss_current_chore].movie)


			//= スタートボタンを非表示 ===
			$('#startRoulette').fadeOut()

			//= 結果画面ボタン表示 ====
			$('#toResult').fadeIn()


			if (Object.keys(result).length === 3) {
				//= 家事選択画面への非表示 ====
				$('#backToStep1').hide()
				//= 最下位発表ボタン表示 ====
				$('#showWorstResult').fadeIn()
			} else if (Object.keys(result).length === 4) {
				//= 家事選択画面への非表示 ====
				$('#backToStep1').hide()
				//= 最下位発表ボタン非表示 ====
				$('#showWorstResult').hide()
				//= 結果画面へ非表示 ====
				$('#toSummary').fadeIn()

			}
		}, 500);
	}

	/** --------------------------------
	 * ルーレット画面に戻る
	 *
	 * @param
	 */

	function back_to_step1() {

		//= videoを停止 ====
		pause_video()

		//= スタートボタンを表示 ===
		$('#startRoulette').fadeIn()

		//= 結果画面ボタン非表示 ====
		$('#toResult').fadeOut()

		//= ルーレットを初期化 ====
		init_roulette()

		//= step1に遷移 ====
		transition('/step1')
	}

	function show_worst_result() {
		//= videoを停止 ====
		pause_video()

		let target_chore = housechore_order.filter(x => !get_result_object_keys().includes(x))[0];
		window.sessionStorage.setItem('ss_current_chore', target_chore)

		let target_player = Object.keys(players_object).filter(x => !get_result_object_values().includes(x))[0];
		$('.pageHousechoreSimulationRoulette__player').removeClass('-selected')
		$('#' + target_player).addClass('-selected')

		init_roulette()
		end_of_audio()
		transition('/step2')
		setTimeout(function() {
			play_video()
		}, 500);
	}

	function to_summary() {
		let result = get_result_object()
		const result_sorted = {};
		Object.keys(result).sort().forEach(key => {
			result_sorted[key] = result[key];
		});

		let i = 0
		for (let chore in result_sorted) {
			if (result_sorted.hasOwnProperty(chore)) {
				++i;
				let player = result_sorted[chore];
				let player_object = get_player_object(player)
				let chore_object = housechore_data_array[chore]

				let item = $('.pageHousechoreSimulationSummary__item:nth-of-type(' + i + ')')

				item.addClass(`-${chore}`)
				item.find('.pageHousechoreSimulationSummary__playerChore').text(chore_object.name)
				item.find('.pageHousechoreSimulationSummary__playerName').text(player_object.name)
				item.find('.pageHousechoreSimulationSummary__playerAka').text(player_object.aka)
				item.find('.pageHousechoreSimulationSummary__video').attr('src', chore_object.movie)
			}
		}

		setTimeout(function() {
			$('.pageHousechoreSimulationSummary__video').each(function() {
				$(this).get(0).play()
			})
		}, 500);
	}


	//================================================
	//
	// 実行
	//
	//================================================
	$(document).ready(function() {
		//= セクション切り替え ====
		section_fade()
		// to_summary()
	});
</script>
<?php get_footer(); ?>

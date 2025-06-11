[1mdiff --git a/routes/web.php b/routes/web.php[m
[1mindex b9631a3..3d35d10 100644[m
[1m--- a/routes/web.php[m
[1m+++ b/routes/web.php[m
[36m@@ -1,5 +1,6 @@[m
 <?php[m
 [m
[32m+[m[32muse App\Http\Controllers\ProfileController;[m
 use Illuminate\Support\Facades\Route;[m
 [m
 use App\Http\Controllers\TaskController;[m
[36m@@ -15,8 +16,16 @@[m
 |[m
 */[m
 [m
[31m-// トップページはタスクリストの「一覧」と同じページにルーティングする設定を入れる[m
 Route::get('/', [TaskController::class, 'index']);[m
[32m+[m[32mRoute::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');[m
 [m
[31m-// タスクを管理するRouterには Route::resource を利用する[m
[31m-Route::resource('tasks', TaskController::class);[m
\ No newline at end of file[m
[32m+[m[32mRoute::middleware('auth')->group(function () {[m
[32m+[m[41m    [m
[32m+[m[32m    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');[m
[32m+[m[32m    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');[m
[32m+[m[32m    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');[m
[32m+[m[41m    [m
[32m+[m[32m    Route::reosurce('tasks', TaskController::class);[m
[32m+[m[32m});[m
[32m+[m
[32m+[m[32mrequire __DIR__.'/auth.php';[m

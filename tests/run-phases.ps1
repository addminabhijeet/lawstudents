param(
    [string] $Php = "C:\xampp\php\php.exe",
    [string] $ComposerPhar = "C:\composer\composer.phar",
    [string] $Npm = "npm.cmd"
)

$ErrorActionPreference = "Continue"
$RepoRoot = (Resolve-Path (Join-Path $PSScriptRoot "..")).Path
$Stamp = Get-Date -Format "yyyyMMdd-HHmmss"
$RunDir = Join-Path $RepoRoot "storage/framework/testing/test-phase-$Stamp"
New-Item -ItemType Directory -Force -Path $RunDir | Out-Null

$envSnapshot = @{}
$testEnv = @{
    APP_ENV = "testing"
    APP_DEBUG = "false"
    APP_URL = "http://localhost"
    APP_KEY = "base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA="
    APP_CONFIG_CACHE = (Join-Path $RunDir "config.php")
    APP_ROUTES_CACHE = (Join-Path $RunDir "routes.php")
    APP_EVENTS_CACHE = (Join-Path $RunDir "events.php")
    VIEW_COMPILED_PATH = (Join-Path $RunDir "views")
    DB_CONNECTION = "sqlite"
    DB_DATABASE = ":memory:"
    DB_URL = "null"
    MAIL_MAILER = "array"
    QUEUE_CONNECTION = "sync"
    SESSION_DRIVER = "array"
    CACHE_STORE = "array"
    LOG_CHANNEL = "null"
    FAST2SMS_API_KEY = "null"
}

function Invoke-Phase {
    param(
        [string] $Name,
        [scriptblock] $Command
    )

    $logPath = Join-Path $RunDir "$Name.log"
    Write-Host "== $Name =="
    & $Command *>&1 | Tee-Object -FilePath $logPath
    $code = $LASTEXITCODE
    if ($null -eq $code) {
        $code = 0
    }
    [pscustomobject]@{ Name = $Name; ExitCode = $code; Log = $logPath }
}

try {
    foreach ($key in $testEnv.Keys) {
        $envSnapshot[$key] = [Environment]::GetEnvironmentVariable($key, "Process")
        [Environment]::SetEnvironmentVariable($key, $testEnv[$key], "Process")
    }

    New-Item -ItemType Directory -Force -Path $env:VIEW_COMPILED_PATH | Out-Null

    $results = @()
    $results += Invoke-Phase "composer-validate" { & $Php $ComposerPhar validate --no-check-publish }
    $results += Invoke-Phase "composer-platform" { & $Php -d extension=gd $ComposerPhar check-platform-reqs }
    $results += Invoke-Phase "frontend-build" { & $Npm run build -- --outDir (Join-Path $RunDir "frontend-build") }
    $results += Invoke-Phase "phpunit" { & $Php -d extension=gd (Join-Path $RepoRoot "vendor/phpunit/phpunit/phpunit") --colors=never --do-not-cache-result --log-junit (Join-Path $RunDir "phpunit.xml") }

    $summaryPath = Join-Path $RunDir "summary.json"
    $results | ConvertTo-Json -Depth 4 | Set-Content -Path $summaryPath -Encoding ASCII
    Write-Host "Summary: $summaryPath"

    if (($results | Where-Object { $_.ExitCode -ne 0 }).Count -gt 0) {
        exit 1
    }
    exit 0
}
finally {
    foreach ($key in $testEnv.Keys) {
        [Environment]::SetEnvironmentVariable($key, $envSnapshot[$key], "Process")
    }
}

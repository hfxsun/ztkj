# 发布到Packagist指南

本文档详细介绍如何将 `buildadmin/enhanced-sms` 包发布到 Packagist 的完整流程。

## 📋 前置条件

### 1. 账户准备
- ✅ GitHub 账户
- ✅ Packagist 账户 (https://packagist.org)
- ✅ Git 环境配置

### 2. 必需文件检查
- ✅ `composer.json` - 包配置文件
- ✅ `README.md` - 说明文档
- ✅ `src/` - 源代码目录
- ✅ LICENSE 文件（可选但建议）

## 🚀 发布步骤

### 第一步：创建GitHub仓库

1. **登录GitHub，创建新仓库**
   ```
   仓库名：enhanced-sms
   描述：Enhanced SMS library with JPush support, compatible with EasySms
   可见性：Public（必须是公开仓库）
   ```

2. **初始化本地仓库**
   ```bash
   cd extend/enhanced-sms
   git init
   git add .
   git commit -m "Initial commit: Enhanced SMS with JPush support"
   ```

3. **关联远程仓库**
   ```bash
   git remote add origin https://github.com/你的用户名/enhanced-sms.git
   git branch -M main
   git push -u origin main
   ```

### 第二步：创建LICENSE文件

创建 `LICENSE` 文件（MIT协议）：

```
MIT License

Copyright (c) 2025 BuildAdmin

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

### 第三步：验证composer.json

确保 `composer.json` 格式正确：

```bash
cd extend/enhanced-sms
composer validate
```

### 第四步：创建版本标签

```bash
# 创建第一个版本
git tag -a v1.0.0 -m "Release version 1.0.0"
git push origin v1.0.0
```

### 第五步：提交到Packagist

1. **登录Packagist**
   - 访问 https://packagist.org
   - 使用GitHub账户登录

2. **提交包**
   - 点击 "Submit"
   - 输入GitHub仓库URL：`https://github.com/你的用户名/enhanced-sms`
   - 点击 "Check"

3. **验证信息**
   - 确认包名：`buildadmin/enhanced-sms`
   - 确认描述和关键词正确
   - 点击 "Submit"

### 第六步：设置自动更新

1. **在Packagist中设置GitHub Webhook**
   - 进入包管理页面
   - 点击 "Settings"
   - 复制 Webhook URL

2. **在GitHub仓库中添加Webhook**
   - 进入GitHub仓库设置
   - 选择 "Webhooks"
   - 添加新Webhook，粘贴URL
   - Content type: `application/json`
   - 选择 "Just the push event"

## 📝 版本管理

### 语义化版本控制
- **主版本号**：不兼容的API修改
- **次版本号**：向下兼容的功能性新增
- **修订号**：向下兼容的问题修正

### 发布新版本流程

```bash
# 1. 修改代码并测试
# 2. 更新版本号（如果需要）
# 3. 提交代码
git add .
git commit -m "feat: add new feature"
git push

# 4. 创建新标签
git tag -a v1.1.0 -m "Release version 1.1.0"
git push origin v1.1.0
```

## 🎯 发布检查清单

### 发布前检查
- [ ] 代码通过所有测试
- [ ] 文档更新完整
- [ ] `composer.json` 信息正确
- [ ] README.md 完善
- [ ] 版本号符合语义化规范

### 发布后验证
- [ ] Packagist 页面显示正常
- [ ] 可以通过 composer 安装
- [ ] 文档链接可访问
- [ ] 徽章显示正确

## 🔧 常见问题

### Q: Packagist 不能自动更新？
A: 检查 GitHub Webhook 设置，确保 URL 正确且测试通过。

### Q: composer install 失败？
A: 检查依赖版本兼容性，确保 PHP 版本要求合理。

### Q: 包名冲突？
A: 更改 `composer.json` 中的包名，使用唯一的 vendor/package 格式。

## 📈 推广建议

1. **添加徽章到 README**
   ```markdown
   [![Latest Stable Version](https://poser.pugx.org/buildadmin/enhanced-sms/v/stable)](https://packagist.org/packages/buildadmin/enhanced-sms)
   [![Total Downloads](https://poser.pugx.org/buildadmin/enhanced-sms/downloads)](https://packagist.org/packages/buildadmin/enhanced-sms)
   [![License](https://poser.pugx.org/buildadmin/enhanced-sms/license)](https://packagist.org/packages/buildadmin/enhanced-sms)
   ```

2. **完善文档**
   - 添加更多使用示例
   - 创建 API 文档
   - 添加贡献指南

3. **社区推广**
   - 在相关论坛分享
   - 写博客介绍特性
   - 收集用户反馈

## 🎉 发布完成

恭喜！你的包现在可以通过以下命令安装：

```bash
composer require buildadmin/enhanced-sms
```

包页面：https://packagist.org/packages/buildadmin/enhanced-sms 
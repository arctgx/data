# 记录linux 命令行常用的小工具使用yum的安装命令

# rz sz 安装
yum install -y lrzsz

# mkpasswd 生成随机密码
# -l 长度，默认9
# -d 包含数字的最少个数，默认2
# -c 包含小写字母的最少个数，默认2
# -C 包含大写字母的最少个数，默认2
# -s 包含特殊字符的最少个数，默认1
yum install -y expect


# jq 命令行解析json
yum install -y jq

# bc linux 命令行计算器
yum install -y bc

# screen 管理多个会话
yum install -y screen

# tree 查看目录结构
yum install -y tree

# cloc 统计代码
yum install -y cloc

# dstat 查看系统情况
yum install -y dstat


# icdiff diff 升级版，依赖 pip
pip install icdiff

# cowsay 'hello world'
# https://en.wikipedia.org/wiki/Cowsay
yum install -y cowsay

# host nslookup 命令
yum install -y bind-utils

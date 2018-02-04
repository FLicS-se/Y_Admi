# 酒情報が追加された際のマッチングテーブルの計算プログラムです

import random
import numpy as np
import copy

SHOP_ID = 1000

# 酒情報の入力 本来ならばサイトで登録された情報が送られてくる
inputLiquor = np.asarray([1000, SHOP_ID, 1, 2, 3, 4, 5])
print(inputLiquor)

# 料理テーブルの作成　本来ならばデータベースから取ってくる
menuLine = 10   # 料理テーブルの行数
MENU_ROW = 7    # 料理テーブルの列数
menuTable = np.asarray([[0 for j in range(MENU_ROW)] for i in range(menuLine)])
# 料理IDと店舗IDを埋める
for i in range(menuLine):
    menuTable[i][0] = 1000 + i
    menuTable[i][1] = SHOP_ID
    # 味情報を埋める
    for j in range(5):
        menuTable[i][j+2] = random.randint(0,9)
print(menuTable)

# ここまでは本来入力されてきたり，データベースから持ってきたりするデータを再現しているだけ

newMenuTable = np.asarray([[0 for j in range(MENU_ROW)]])
menuTableTemp = np.asarray([[0 for j in range(MENU_ROW)]])
flag = 0
for i in range(menuLine):
    if menuTable[i][1] == inputLiquor[1] and flag == 0:
        newMenuTable = copy.deepcopy(menuTable[i])
        flag = 1
    elif menuTable[i][1] == inputLiquor[1]:
        menuTableTemp = copy.deepcopy(menuTable[i])
        newMenuTable = np.vstack((newMenuTable, menuTableTemp))
    else:
        continue
print("newMenuTable")
print(newMenuTable)


"""
np.vstackの性質上1回目は違う方法で match_table に代入

イメージ

1回目
空っぽの match_table に店舗ID，酒ID，料理ID，味の違いを代入
match_table
 -------------------------------
|店舗ID | 酒ID | 料理ID | 味の違い |  <-- 1回目
 -------------------------------

2回目以降
中身のある match_table に対して np.vstack を実行する
np.vstack は配列に対して行の追加を行う．
match_table
 -------------------------------
|店舗ID | 酒ID | 料理ID | 味の違い |  <-- 1回目
 -------------------------------
|店舗ID | 酒ID | 料理ID | 味の違い |  <-- 2回目以降どんどん下にくっつける
 -------------------------------
                    ・・・
        
        
"""
# マッチング情報テーブルの計算
flag = 0
MATCH_ROW = 4
compMatchTable = np.asarray([[0 for j in range(MATCH_ROW)]])
matchTableTemp = np.asarray([[0 for j in range(MATCH_ROW)]])
for i in range(newMenuTable.shape[0]):
    #if inputLiquor[1] == menuTable[i][1]:
    matchTableTemp[0][0] = inputLiquor[1]
    matchTableTemp[0][1] = newMenuTable[i][0]
    matchTableTemp[0][2] = inputLiquor[0]
    matchTableTemp[0][3] = sum(list(map(abs, inputLiquor[2:] - newMenuTable[i][2:])))
    #print(matchTableTemp[0][3])
    if flag == 0:
        compMatchTable = copy.deepcopy(matchTableTemp)
        flag = 1
    else:
        compMatchTable = np.vstack((compMatchTable, matchTableTemp))
print(compMatchTable)

"""
ここまでで入力された酒情報に対する，"全ての"料理との味の違いが"バラバラに"入力されている．
"""

# "バラバラな"マッチング情報テーブルの味の違いを昇順にソート
if compMatchTable.shape[0] > 1: # compMatchTable の行数が1の時はやらない
    compMatchTable = compMatchTable[compMatchTable[:,3].argsort(), :] # 味の違いに対して昇順にソート
    #print(compMatchTable)

# ソートされた compMatchTable に対して上位3つを抽出
MATCH_NUMBER = 3 # マッチングする料理の数
if compMatchTable.shape[0] > MATCH_NUMBER-1:
    compMatchTable = compMatchTable[:3][:] # 上位3つを抽出


# 入力されたお酒に対する味情報テーブル    
print(compMatchTable)

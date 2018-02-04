import random
import numpy as np
import copy

SHOP_ID = 1000

# 料理情報の入力
inputMenu = np.asarray([1000, SHOP_ID, 1, 2, 3, 4, 5])################
print("追加された料理情報")
print(inputMenu)

# 酒情報テーブルの作成
liquorNum = 10 # 酒IDの数
LIQUOR_ROW = 7
liquorTable = np.asarray([[0 for j in range(LIQUOR_ROW)] for i in range(liquorNum)])
for i in range(liquorNum):
    liquorTable[i][0] = 1000 + i
    liquorTable[i][1] = SHOP_ID + random.randint(0,1)
    for j in range(5):
        liquorTable[i][j+2] = random.randint(0, 9)
print("酒情報テーブル")
print(liquorTable)

# マッチング情報テーブルの作成
MATCHING_ROW = 4 # マッチング情報テーブルの列数
matchTable = np.asarray([[0 for j in range(MATCHING_ROW)]])
firstFlag = 0
count = 0
liquorMatchTemp = np.asarray([[0 for j in range(MATCHING_ROW)]]) # 1つのお酒に対する料理の相性を代入する
for i in range(liquorNum):
    a = random.randint(0, 15)
    for j in range(random.randint(1,3)):
        liquorMatchTemp[0][0] = SHOP_ID
        if count < 6:
            liquorMatchTemp[0][0] = SHOP_ID + 1
            count += 1
        liquorMatchTemp[0][1] = 1000 + i
        liquorMatchTemp[0][2] = random.randint(1000, 1100)
        liquorMatchTemp[0][3] = a
        if firstFlag == 0:
            liquorMatchTemp[0][3] = a - round(a/2)
            matchTable = copy.deepcopy(liquorMatchTemp)
            firstFlag = 1
        else:
            a = a + random.randint(0, 10)
            matchTable = np.vstack((matchTable, liquorMatchTemp))
print("マッチング情報テーブル")
print(matchTable)

"""
^
|ここまで入力されてくる
--------------------
|ここから計算

"""

# 追加された料理情報テーブルと等しい店舗IDをもつ酒情報テーブルを作成
liquorTableTemp = np.asarray([[0 for j in range(MATCHING_ROW)]])
newLiquorTable = np.asarray([[0 for j in range(MATCHING_ROW)]])
flag = 0
for i in range(liquorNum):
    if liquorTable[i][1] == inputMenu[1] and flag == 0:
        liquorTableTemp = copy.deepcopy(liquorTable[i])
        newLiquorTable = copy.deepcopy(liquorTable[i])
        flag = 1
    elif liquorTable[i][1] == inputMenu[1]:
        liquorTableTemp = copy.deepcopy(liquorTable[i])
        newLiquorTable = np.vstack((newLiquorTable, liquorTableTemp))
    else:
        continue
print("newLiquorTable")
print(newLiquorTable)

# 追加された料理情報テーブルと等しい店舗IDをもつマッチング情報テーブルを作成
matchTableTemp = np.asarray([[0 for j in range(MATCHING_ROW)]])
newMatchTable = np.asarray([[0 for j in range(MATCHING_ROW)]])
flag = 0
for i in range(matchTable.shape[0]):
    if matchTable[i][0] == inputMenu[1] and flag == 0:
        matchTableTemp = copy.deepcopy(matchTable[i])
        newMatchTable = copy.deepcopy(matchTable[i])
        flag = 1
    elif matchTable[i][0] == inputMenu[1]:
        matchTableTemp = copy.deepcopy(matchTable[i])
        newMatchTable = np.vstack((newMatchTable, matchTableTemp))
    else:
        continue
print("newMatchTable")
print(newMatchTable)


# 入力された料理情報と酒情報の味の違いを計算
firstFlag = 0
menuMatchTemp = np.asarray([[0 for j in range(MATCHING_ROW)]]) # 入力された料理に対する，お酒との相性を代入する
matchLquorAndMenu = np.asarray([[0 for j in range(MATCHING_ROW)]]) # 入力された料理に対する"全ての"お酒との相性を代入する
#print(newMatchTable[8][0])
for i in range(newLiquorTable.shape[0]):
    menuMatchTemp[0][0] = inputMenu[0]
    menuMatchTemp[0][1] = newLiquorTable[i][0]
    menuMatchTemp[0][2] = inputMenu[0]
    menuMatchTemp[0][3] = sum(list(map(abs, inputMenu[2:] - newLiquorTable[i][2:])))
    if firstFlag == 0:
        matchLquorAndMenu = copy.deepcopy(menuMatchTemp)
        firstFlag = 1
    else:
        matchLquorAndMenu = np.vstack((matchLquorAndMenu, menuMatchTemp))
    #print(menuMatchTemp)
    #print(matchLquorAndMenu)
print("matchLquorAndMenu")
print(matchLquorAndMenu)

# 入力された料理に対する全てのお酒の味情報と，マッチング情報テーブルの味情報を比べて，マッチング情報テーブルを更新する
firstFlag = 0
matchInputMenuMutch = np.asarray([[0 for j in range(MATCHING_ROW)]]) # マッチング情報テーブルの1つのお酒に対する料理の相性を代入し，新たに入力された料理の相性を代入する
sortMatchInputMenu = np.asarray([[0 for j in range(MATCHING_ROW)]]) # matchInputMenuMutchの味情報を昇順にソートしたものを代入する
compMatchTable = np.asarray([[0 for j in range(MATCHING_ROW)]]) # 新しいマッチングテーブル
flag = 0
for i in range(matchLquorAndMenu.shape[0]):
    matchInputMenuMutch = copy.deepcopy(matchLquorAndMenu[i])
    for j in range(newMatchTable.shape[0]):
        if matchLquorAndMenu[i][1] == newMatchTable[j][1]:
            matchInputMenuMutch = np.vstack((matchInputMenuMutch, newMatchTable[j]))
            flag = 1
    if flag == 0:
        continue
    #print(matchInputMenuMutch)
    #print("a")
    sortMatchInputMenu = copy.deepcopy(matchInputMenuMutch)
    #print(sortMatchInputMenu.shape[0])
    matchInputMenuMutch = np.asarray([[0 for j in range(MATCHING_ROW)]]) # matchInputMenuMutchの初期化
    
    if sortMatchInputMenu.shape[0] > 1:
        sortMatchInputMenu = sortMatchInputMenu[sortMatchInputMenu[:,3].argsort(), :] # 味の違いに対して昇順にソート
        #print("ソート")
        #print(sortMatchInputMenu)

    # ソートされた newMatchTable に対して上位3つを抽出
    MATCHING_NUMBER = 3 # マッチングする料理の数
    if sortMatchInputMenu.shape[0] > MATCHING_NUMBER-1:
        sortMatchInputMenu = sortMatchInputMenu[:3][:] # 上位3つを抽出
        #print("上位3")
        #print(sortMatchInputMenu)

    if firstFlag == 0:
        compMatchTable = copy.deepcopy(sortMatchInputMenu)
        firstFlag = 1
    else:
        compMatchTable = np.vstack((compMatchTable, sortMatchInputMenu))
    #print("compMatchTable")
    #print(compMatchTable)
    flag = 0
print("完成")
print(compMatchTable)

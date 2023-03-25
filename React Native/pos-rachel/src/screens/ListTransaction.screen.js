import React, { Fragment, useState, useEffect } from "react"
import { Text, View, Dimensions, ScrollView, TouchableHighlight, Image, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon, XIcon } from "react-native-heroicons/solid"
import { NewspaperIcon, TrashIcon, DocumentIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import AsyncStorage from "@react-native-async-storage/async-storage"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"

const ListTransaction = ({ navigation, transactions, changeTransactions, changeCart, cart, user }) => {
    const [height, setHeight] = useState(0)
    const [widthScreen, setWidthScreen] = useState(0)
    const [idDelete, setIdDelete] = useState(null)
    const [idModal, setIdModal] = useState(null)

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    const deleteTransaction = (index) => {
        const result = transactions.filter((item, indexItem) => {
            return indexItem !== index
        })

        changeTransactions(result)
        AsyncStorage.setItem("transactions", JSON.stringify(result))

        setIdDelete(null)
    }

    useEffect(() => {
        setWidthScreen(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    useEffect(() => {
        AsyncStorage.getItem("transactions")
            .then(result => {
                changeTransactions(JSON.parse(result))
            }).catch(error => console.log(error.message))
    }, [])

    const renderName = (data) => {
        let name = ""

        data.forEach((item, index) => {
            name += (index === data.length - 1) ? item.name : `${ item.name }, `
        })

        return name
    }

    const renderTime = (data) => {
        const timeSplit = data.split(":")
        let result = ""

        if(parseInt(timeSplit[0]) < 10) {
            result += `0${ timeSplit[0] }`
        } else {
            result += `${ timeSplit[0] }`
        }

        if(parseInt(timeSplit[1]) < 10) {
            result += `:0${ timeSplit[1] }`
        } else {
            result += `:${ timeSplit[1] }`
        }

        return result
    }

    const renderPrice = (data) => {
        let result = 0

        data.forEach((item) => {
            result += parseFloat(fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")).split(",").join("")) * item.qty
        })

        return result
    }

    const addToCart = async () => {
        setIdModal(null)

        changeCart([...cart, ...transactions[idModal].data])
        await AsyncStorage.setItem("cart", JSON.stringify([...cart, ...transactions[idModal].data]))

        await AsyncStorage.setItem("transactions", JSON.stringify(transactions.filter((item, index) => index !== idModal)))
        changeTransactions(transactions.filter((item, index) => index !== idModal))

        navigation.replace("Transaction")
    }

    const fixingNumberAmount = (value) => {
        const splitValue = value.split(",")[value.split(",").length - 1].split("").slice(1, 3).join("")
        let result = ""
        let arrResult = value.split(",")

        if(parseInt(splitValue) > 0 && parseInt(splitValue) <= 99) {
            result = `${ parseInt(value.split(",")[value.split(",").length - 1].split("")[0]) + 1 }00`

            if(parseInt(result) >= 1000) {
                result = "000"
                arrResult[arrResult.length - 2] = parseInt(arrResult[arrResult.length - 2]) + 1
            }
        } else {
            result = value.split(",")[value.split(",").length - 1]   
        }

        arrResult[arrResult.length - 1] = result
        arrResult = arrResult.join("")

        return arrResult.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                    <ScrollView showsVerticalScrollIndicator={ false }>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6 mb-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => navigation.goBack() }>
                                    <ArrowLeftIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Transaksi Tersimpan
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <Image
                                    source={ { uri: user.avatar } }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                />
                            </View>
                        </View>
                            {
                                transactions.length ?
                                    React.Children.toArray(transactions.map((item, index) => {
                                        return (
                                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIdModal(index) } style={ Tailwind`mb-3` }>
                                                <View style={ Tailwind`w-full flex flex-row items-center justify-between p-6 bg-white rounded-2xl` }>
                                                    <View style={ Tailwind`flex flex-row items-center` }>
                                                        <NewspaperIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70 mr-5` }/>
                                                        <View style={ Tailwind`flex flex-col` }>
                                                            <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                                                { renderName(item.data) }
                                                            </Text>
                                                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-80` }>
                                                                Rp{ fixingNumberAmount(renderPrice(item.data).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                                            </Text> 
                                                        </View>
                                                    </View>
                                                    <View style={ Tailwind`flex flex-row items-center` }>
                                                        <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-40` }>
                                                            { renderTime(item.time) }
                                                        </Text> 
                                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIdDelete(index) }>
                                                            <TrashIcon size={ 18 } style={ Tailwind`text-accent--black opacity-70 ml-3` }/>
                                                        </TouchableHighlight>
                                                    </View>
                                                </View>
                                            </TouchableHighlight>
                                        )
                                    })) :
                                    <View style={ Tailwind`flex flex-col items-center justify-center` }>
                                        <Image
                                            source={ require("../assets/ilustrations/box.png") }
                                            resizeMode={ "contain" }
                                            style={ Tailwind`w-60 h-60` }
                                        />
                                        <Text style={ Tailwind`font-medium text-accent--black text-sm` }>
                                            Tidak Ada Transaksi Tersimpan
                                        </Text>
                                        <Text style={ Tailwind`text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                            Silahkan tambahkan transaksi baru di halaman kasir.
                                        </Text>
                                    </View>
                            }
                    </ScrollView>
                </View>
                {
                    idModal !== null ? 
                    <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                        <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-semibold text-lg text-accent--black` }>
                                    Detail Transaksi
                                </Text>
                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIdModal(null) }>
                                    <XIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                </TouchableHighlight>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center mt-5 mb-3 w-full` }>
                                <DocumentIcon size={ 22 } style={ Tailwind`text-accent--black opacity-70` }/>
                                <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black opacity-80 ml-2` }>{ renderName(transactions[idModal].data) }</Text>
                            </View>
                            <View style={ Tailwind`w-full h-px bg-gray-200 mb-5` }/>
                            {
                                React.Children.toArray(transactions[idModal].data.map(item => {
                                    return (
                                        <View style={ Tailwind`flex flex-col w-full my-1` }>
                                            <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                                    { item.name }
                                                </Text>
                                            </View>
                                            <View style={ Tailwind`flex flex-row items-center justify-between mt-1` }>
                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                    Rp{ fixingNumberAmount((item.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) } x { item.qty }
                                                </Text>
                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                    Rp{ fixingNumberAmount((item.price * item.qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                                </Text>
                                            </View>
                                        </View>
                                    )
                                }))
                            }
                            <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`w-full` } onPress={ () => addToCart() }>
                                <ButtonPrimary text={ "Lanjutkan ke Keranjang" }/>
                            </TouchableHighlight>
                        </View>
                    </View> : null
                }
                {
                    idDelete != null ?
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                                <View style={ Tailwind`w-full flex flex-col items-center` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                        Hapus Transaksi
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 text-center` }>
                                        Anda yakin ingin menghapus transaksi ini?
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => setIdDelete(null) }>
                                        <ButtonSecondary text={ "Tidak" }/>
                                    </TouchableHighlight>
                                    <View style={ Tailwind`w-3` }/>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => deleteTransaction(idDelete) } style={ Tailwind`flex-1` }>
                                        <ButtonPrimary text={ "Hapus" }/>
                                    </TouchableHighlight>
                                </View>
                            </View>
                        </View> : null
                }
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        transactions : state.transactions,
        cart: state.cart,
        user: state.user
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeTransactions : (value) => dispatch({type: 'CHANGE_TRANSACTIONS', newValue: value}),
        changeCart: (value) => dispatch({type: 'CHANGE_CART', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(ListTransaction)
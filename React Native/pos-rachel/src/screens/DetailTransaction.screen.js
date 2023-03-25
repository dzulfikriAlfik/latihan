import React, { Fragment, useState, useEffect } from "react"
import { Text, ScrollView, TouchableHighlight, Image, View, Dimensions, ToastAndroid, ActivityIndicator, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon } from "react-native-heroicons/solid"
import { connect } from "react-redux"
import { BLEPrinter } from "react-native-thermal-receipt-printer"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"

const DetailTransaction = ({ navigation, route, user, currentPrinter, changeCurrentPrinter }) => {
    const [height, setHeight] = useState(0)
    const [printers, setPrinters] = useState([])
    const [isShow, setIsShow] = useState(false)
    const [isLoading, setIsLoading] = useState(false)

    console.log(route.params.data.detail_order)

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    useEffect(() => {
        BLEPrinter.init().then(() => {
            BLEPrinter.getDeviceList().then(results => {
                setPrinters(results)
            })
        })
    }, [])

    const connectPrinter = (printer) => {
        setIsLoading(true)

        BLEPrinter.connectPrinter(printer.inner_mac_address)
            .then((result, error) => {
                if(error) return ToastAndroid.show("Failed connecting printer.", 1500)

                changeCurrentPrinter(result)
                ToastAndroid.show("Success connecting printer.", 1500)
            }).catch(error => {
                ToastAndroid.show("Failed connecting printer.", 1500)
            }).finally(() => setIsLoading(false))
    }

    const renderSpace = (text1, text2) => {
        let space = 32
        let result = ""

        space -= text1.split("").length
        space -= text2.split("").length

        result += text1
        
        for (let index = 0; index < space; index++) {
            result += " "
        }

        result += text2
        return result
    }

    const randomString = () => {
        let text = ""
        const possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890097213897012938214213"

        for (let index = 0; index < 8; index++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length))
        }

        return text
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

    const printStruct = () => {
        if(currentPrinter) {
            let text = ""

            text += "<CB>WEMART</CB>\n\n"
            text += `<C>Wemart ${ user.stores[0].name_store }</C>\n`
            text += `<C>${ user.stores[0].address_store }</C>\n`
            text += "<C>Kota Bandung</C>\n"
            text += `<C>${ user.phone }</C>\n\n`
            text += `${ renderSpace("Kasir", user.name) }\n`
            text += `${ renderSpace("Waktu", route.params.data.order.created_at.toString()) }\n`
            text += `${ renderSpace("No.Struk", "#INV-"+randomString()) }\n`
            text += `${ renderSpace("Jenis Pembayaran", route.params.data.order.payment_method) }\n`
            text += `${ renderSpace("Pelanggan", "-") }\n`
            text += `................................\n\n`
            route.params.data.detail_order.forEach((item) => {
                text += `${ item.item.name }\n`
                text += `${ renderSpace(`Rp${ fixingNumberAmount(item.item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) } x ${ item.qty }`, `Rp${ fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }`) }\n`
                if(item.discount_item) {
                    text += `${ renderSpace(`Diskon`, `Rp${ item.discount_item.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n\n`
                } else {
                    text += "\n"
                }
            })
            text += `................................\n\n`
            text += `${ renderSpace("Sub Total", `Rp${ (route.params.data.order.order_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
            text += `${ renderSpace("Diskon", `Rp${ Math.floor(route.params.data.order.discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
            text += `${ renderSpace("Voucher", `Rp${ (route.params.data.order.coupon_discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
            text += `................................\n\n`
            text += `${ renderSpace("Total", `Rp${ (route.params.data.order.order_amount - route.params.data.order.coupon_discount_amount < 0 ? 0 : route.params.data.order.order_amount - route.params.data.order.coupon_discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
            text += `................................\n\n`
            text += `${ renderSpace("Bayar", `Rp${ route.params.data.order.pay_amount.split(".")[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }`) }\n`
            text += `${ renderSpace("Kembali", `${ route.params.data.order.order_amount <= route.params.data.order.coupon_discount_amount ? "Rp0" : route.params.data.order.pay_amount < (route.params.data.order.order_amount - route.params.data.order.coupon_discount_amount) ? `Rp0` : `Rp${ (route.params.data.order.pay_amount - (route.params.data.order.order_amount - route.params.data.order.coupon_discount_amount)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }` }`) }\n\n\n\n`
            text += "<C>Powered by WEMART</C>\n"
            text += "<C>www.wemart.co.id</C>"

            BLEPrinter.printBill(text)

            setIsShow(false)
        } else {
            ToastAndroid.show("Print not ready connected.", 1500)
        }
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
                                #{ route.params.data.order.id }
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
                    <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl` }>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                            <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                Detail Transaksi
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-sm text-accent--black` }>
                                #{ route.params.data.order.id }
                            </Text>
                        </View>
                        <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                Tipe Pembayaran
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                { route.params.data.order.payment_method }
                            </Text>
                        </View>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between my-2` }>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                Nama Pegawai
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                { user.name }
                            </Text>
                        </View>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                Tanggal Transaksi
                            </Text>
                            <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                { route.params.data.order.created_at }
                            </Text>
                        </View>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-10` }>
                            <View style={ Tailwind`flex-1 py-5 flex flex-row justify-center border border-gray-200 rounded-md` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Kirim Struk
                                </Text>
                            </View>
                            <View style={ Tailwind`w-5` }/>
                            {/* <View style={ Tailwind`flex-1 py-5 flex flex-row justify-center border border-gray-200 rounded-md` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Batalkan
                                </Text>
                            </View> */}
                            {/* <View style={ Tailwind`w-5` }/> */}
                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => Object.keys(currentPrinter).length ? printStruct() : setIsShow(true) } style={ Tailwind`flex-1 py-5 flex flex-row justify-center bg-primary--red rounded-md` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-white` }>
                                    Cetak Struk
                                </Text>
                            </TouchableHighlight>
                        </View>
                    </View>
                    <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                        <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                            Detail Pembelian
                        </Text>
                        <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                        <View>
                            {
                                React.Children.toArray(route.params.data.detail_order.map((item) => {
                                    return (
                                        <View style={ Tailwind`flex flex-col mb-2` }>
                                            <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                                    { item.item.name }
                                                </Text>
                                            </View>
                                            <View style={ Tailwind`flex flex-row items-center justify-between mt-1` }>
                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                    Rp{ fixingNumberAmount(item.item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) } x { item.qty }
                                                </Text>
                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                    Rp{ fixingNumberAmount(item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")) }
                                                </Text>
                                            </View>
                                            <View style={ Tailwind`flex flex-row items-center justify-between mt-1` }>
                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                    Diskon
                                                </Text>
                                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                                    Rp{ item.discount_item.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                                </Text>
                                            </View>
                                        </View>
                                    )
                                }))
                            }
                            <View style={ Tailwind`w-full h-px bg-gray-200 my-5` }/>
                            <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                    Subtotal
                                </Text>
                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                    Rp{ route.params.data.order.order_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center justify-between my-1` }>
                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                    Diskon
                                </Text>
                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                    Rp{ Math.floor(route.params.data.order.discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center justify-between my-1` }>
                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                    Voucher
                                </Text>
                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                    Rp{ route.params.data.order.coupon_discount_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-medium text-sm text-accent--black` }>
                                    Total
                                </Text>
                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 tracking-wide` }>
                                    Rp{ (route.params.data.order.order_amount - route.params.data.order.coupon_discount_amount < 0 ? 0 : route.params.data.order.order_amount - route.params.data.order.coupon_discount_amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                </Text>
                            </View>
                        </View>
                    </View>
                    <View style={ Tailwind`h-6` }/>
                </ScrollView>
            </View>
            {
                isShow ?
                    <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                        <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col` }>
                            <View style={ Tailwind`w-full flex flex-col` }>
                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                    Daftar Printer
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 text-left mt-1` }>
                                    Note: Jika printer memiliki password ketika diakses, pastikan sudah terhubung.
                                </Text>
                                <View style={ Tailwind`w-full mt-5 mb-2 h-px bg-gray-200` }/>
                                {
                                    React.Children.toArray(printers.map(item => {
                                        return (
                                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-3` }>
                                                <Text style={ Tailwind`font-rubik-medium text-base text-accent--black` }>
                                                    { item.inner_mac_address }
                                                </Text>
                                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => currentPrinter.device_name === item.device_name ? null : connectPrinter(item) }>
                                                    <Text style={ Tailwind`font-rubik-medium text-sm text-gray-400` }>
                                                        { currentPrinter.device_name === item.device_name ? "Terhubung" : "Hubungkan" }
                                                    </Text>
                                                </TouchableHighlight>
                                            </View>
                                        )
                                    }))
                                }
                            </View>
                            <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => setIsShow(false) }>
                                    <ButtonSecondary text={ "Batal" }/>
                                </TouchableHighlight>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1 ml-2` } onPress={ () => printStruct() }>
                                    <ButtonPrimary text={ "Cetak" }/>
                                </TouchableHighlight>
                            </View>
                        </View>
                    </View> : null
                }
                {
                    isLoading ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                            <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                        </View> : null
                }
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        user : state.user,
        currentPrinter: state.currentPrinter
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeCurrentPrinter : (value) => dispatch({type: 'CHANGE_CURRENTPRINTER', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(DetailTransaction)
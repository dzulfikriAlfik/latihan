import React, { Fragment, useState, useEffect } from "react"
import { Dimensions, SafeAreaView, ScrollView, Text, TouchableHighlight, View, Image, ActivityIndicator, TextInput, ToastAndroid } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon } from "react-native-heroicons/solid"
import { BellIcon, NewspaperIcon, ArrowCircleRightIcon } from "react-native-heroicons/outline"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
// import ItemReport from "../components/molecules/ItemReport.molecule"
import Drawer from "../components/organisms/Drawer.organism"
import { connect } from "react-redux"
import GestureRecognizer from "react-native-swipe-detect"
import NotificationSidebar from "../components/organisms/NotificationSidebar.organism"
import ReportFetching from "../libs/fetching/ReportFetching.lib"
import AsyncStorage from "@react-native-async-storage/async-storage"
import Axios from "../configs/axios/Axios.config"

const Home = ({ changeDrawerStatus, changeNotificationSidebarStatus, navigation, user }) => {
    const [height, setHeight] = useState(0)
    const [widthScreen, setWidthScreen] = useState(0)
    const [isLoading, setIsLoading] = useState(false)
    const [reports, setReports] = useState([])
    const [isShow, setIsShow] = useState(false)
    const [username, setUsername] = useState("")

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    useEffect(() => {
        changeDrawerStatus(false)
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
        async function initData() {
            setIsLoading(true)

            const data = await ReportFetching().monthlyReport()
            
            setReports([...data])
            setIsLoading(false)
        }

        initData()
    }, [])

    const renderMonth = (param) => {
        const months = Object.freeze({
            "01": "January",
            "02": "February",
            "03": "Maret",
            "04": "April",
            "05": "Mei",
            "06": "Juni",
            "07": "Juli",
            "08": "Agustus",
            "09": "September",
            "10": "Oktober",
            "11": "November",
            "12": "Desember",
        })

        return months[param.toString()]
    }

    const handleSubmit = async () => {
        setIsLoading(true)
        setIsShow(false)

        const token = await AsyncStorage.getItem("token")

        try {
            const response = await Axios.post(
                "/vendor/cek-employee",
                {
                    username
                },
                {
                    headers: {
                        "Authorization": `Bearer ${ JSON.parse(token) }`
                    }
                }
            )

            if(response.data["0"] == 401) {
                ToastAndroid.show(response.data.message, 1500)
            } else {
                AsyncStorage.setItem("employe", JSON.stringify(response.data.data))
                    .then(() => navigation.reset({ index: 0, routes: [{ name: "Transaction" }] }))
                    .catch((error) => ToastAndroid.show("Failed when store data employe.", 1500))
            }
        } catch (error) {
            ToastAndroid.show("Failed when submit data.", 1500)
        } finally {
            setIsLoading(false)
            setUsername("")
        }
    }

    useEffect(() => {
        async function initData() {
            setIsLoading(true)

            const employe = await AsyncStorage.getItem("employe")

            setIsLoading(false)

            if(employe) {
                navigation.reset({ index: 0, routes: [{ name: "Transaction" }] })
            }
        }

        initData()
        setIsShow(false)
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <Drawer/>
                <NotificationSidebar/>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6 pb-6`, { height }] }>
                    <ScrollView>
                        <GestureRecognizer onSwipeRight={ () => changeDrawerStatus(true) }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => changeDrawerStatus(true) }>
                                        <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                    </TouchableHighlight>
                                    <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                        Beranda
                                    </Text>
                                </View>
                                <Image
                                    source={ require("../assets/images/logo-red.png") }
                                    style={ Tailwind`w-45 h-15` }
                                    resizeMode={ "contain" }
                                />
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => changeNotificationSidebarStatus(true) }>
                                        <BellIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                    </TouchableHighlight>
                                    {
                                        user ?
                                            <Image
                                                source={ { uri: user.avatar } }
                                                resizeMode={ "contain" }
                                                style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                            /> : 
                                            <ActivityIndicator size={ "small" }/>
                                    }
                                </View>
                            </View>
                        </GestureRecognizer>
                        <View style={ Tailwind`w-full pb-32 flex flex-col bg-white p-6 rounded-3xl mt-5` }>
                            {
                                reports.length ?
                                    React.Children.toArray(reports.map((report, index) => {
                                        if(index != 0) {
                                            return (
                                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("DetailReportMonthly", { data: {
                                                    date: report.created_at
                                                } }) }>
                                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between bg-primary--red--20 p-5 rounded-lg mb-3` }>
                                                        <View style={ Tailwind`flex flex-row items-center` }>
                                                            <NewspaperIcon size={ 24 } style={ Tailwind`text-primary--red opacity-70` }/>
                                                            <View style={ Tailwind`flex flex-col ml-5` }>
                                                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-50` }>
                                                                    Ringkasan Penjualan
                                                                </Text>
                                                                <Text style={ Tailwind`font-rubik-medium text-base text-primary--red opacity-70` }>
                                                                    Bulan { renderMonth(report.created_at.split(" ")[0].split("-")[1]) } { report.created_at.split(" ")[0].split("-")[0] }
                                                                </Text>
                                                            </View>
                                                        </View>
                                                        <View style={ Tailwind`flex flex-row items-center` }>
                                                            <Text style={ Tailwind`font-rubik-medium text-xs text-primary--red text-lg` }>
                                                                Rp{ report.total_transaction.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                                            </Text>
                                                            <ArrowCircleRightIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70 ml-5` }/>
                                                        </View>
                                                    </View>
                                                </TouchableHighlight>
                                            )
                                        }
                                    })) :
                                    <View style={ Tailwind`flex flex-col items-center mt-20 mb-30` }>
                                        <Image
                                            source={ require("../assets/ilustrations/box.png") }
                                            resizeMode={ "contain" }
                                            style={ Tailwind`w-50 h-50` }
                                        />
                                        <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                            Tidak ada Laporan
                                        </Text>
                                        <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                            Silahkan lakukan transaksi pada halaman kasir
                                        </Text>
                                    </View>
                            }
                            {/* <View style={ Tailwind`w-full flex ${ handleResponsive(["flex-col", "flex-row"]) } items-center justify-between` }>
                                <ItemReport title={ "Produk Terlaris" } data={ "Makanan dan Minuman Jenis A" }/>
                                <View style={ Tailwind`${ handleResponsive(["h-5", "w-5"]) }` }/>
                                <ItemReport title={ "Kategori Terlaris" } data={ "Sembako" }/>
                                <View style={ Tailwind`${ handleResponsive(["h-5", "w-5"]) }` }/>
                                <ItemReport title={ "Total Transaksi" } data={ "999" }/>
                                <View style={ Tailwind`${ handleResponsive(["h-5", "w-5"]) }` }/>
                                <ItemReport title={ "Total Keuntungan" } data={ "Rp2.000.000.000" }/>
                            </View>
                            <View style={ Tailwind`w-full flex ${ handleResponsive(["flex-col", "flex-row"]) } items-center justify-between mt-5` }>
                                <ItemReport title={ "Total Penjualan" } data={ "Penjualan - Diskon/Promo + Pajak" }/>
                                <View style={ Tailwind`${ handleResponsive(["h-5", "w-5"]) }` }/>
                                <ItemReport title={ "Metode Pembayaran Terpopuler" } data={ "Pembayaran yang sering digunakan" }/>
                                <View style={ Tailwind`${ handleResponsive(["h-5", "w-5"]) }` }/>
                                <ItemReport title={ "Tipe Order" } data={ "Tipe Order yang banyak digunakan" }/>
                            </View> */}
                            <TouchableHighlight style={ Tailwind`w-full mt-10` } onPress={ () => setIsShow(true) }>
                                <ButtonPrimary text={ "Mulai Jualan" }/>
                            </TouchableHighlight>
                        </View>
                    </ScrollView>
                </View>
                {
                    isLoading ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                            <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                        </View> : null
                }
                {
                    isShow ?
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                                <View style={ Tailwind`w-full flex flex-col items-start` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                        Login Akun Pegawai
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                                <TextInput
                                    placeholder="Username"
                                    style={ Tailwind`w-full p-4 rounded-md bg-gray-100 font-rubik-regular text-accent--black text-sm` }
                                    value={ username }
                                    onChangeText={ (value) => setUsername(value) }
                                />
                                <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => setIsShow(false) }>
                                        <ButtonSecondary text={ "Batal" }/>
                                    </TouchableHighlight>
                                    <View style={ Tailwind`w-3` }/>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => handleSubmit() } style={ Tailwind`flex-1` }>
                                        <ButtonPrimary text={ "Submit" }/>
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
        user : state.user
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
        changeNotificationSidebarStatus : (value) => dispatch({type: 'CHANGE_NOTIFICATIONSIDEBARSTATUS', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Home)
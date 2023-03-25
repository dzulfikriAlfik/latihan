import React, { Fragment, useState, useEffect } from "react"
import { Text, View, Dimensions, ScrollView, TouchableHighlight, Image, TextInput, ActivityIndicator, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon, NewspaperIcon } from "react-native-heroicons/solid"
import { CogIcon, ArrowCircleRightIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import Drawer from "../components/organisms/Drawer.organism"
import ReportFetching from "../libs/fetching/ReportFetching.lib"

const LogReport = ({ changeDrawerStatus, navigation, user }) => {
    const [height, setHeight] = useState(0)
    const [widthScreen, setWidthScreen] = useState(0)
    const [reports, setReports] = useState([])
    const [isLoading, setIsLoading] = useState(false)

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
        changeDrawerStatus(false)
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    useEffect(() => {
        async function initData() {
            setIsLoading(true)

            const data = await ReportFetching().dailyReport()

            setReports([...data])
            setIsLoading(false)
        }

        initData()
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <Drawer/>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                    <ScrollView showsVerticalScrollIndicator={ false }>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6 mb-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => changeDrawerStatus(true) }>
                                    <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Laporan
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                {/* <View style={ Tailwind`${ handleResponsive(["w-40 ml-6","w-80 ml-5"]) } px-3 py-2 rounded-md bg-gray-100 flex flex-row items-center border border-primary--red` }>
                                    <SearchIcon size={ 22 } style={ Tailwind`text-primary--red opacity-70` }/>
                                    <TextInput
                                        scrollEnabled={ false }
                                        placeholder={ "Cari" }
                                        style={ Tailwind`p-0 text-sm text-primary--red flex-grow ml-3 tracking-wide font-rubik-regular` }
                                        placeholderTextColor={ "#F2414180" }
                                    />
                                </View>
                                <CogIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70 ml-5` }/> */}
                                <Image
                                    source={ { uri: user.avatar } }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                />
                            </View>
                        </View>
                        {
                            reports.length ? 
                                React.Children.toArray(reports.map(report => {
                                    return (
                                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("DetailReportDaily", { data: {
                                            date: report.created_at
                                        } }) }>
                                            <View style={ Tailwind`w-full flex flex-row items-center justify-between bg-white p-5 rounded-lg mb-3` }>
                                                <View style={ Tailwind`flex flex-row items-center` }>
                                                    <NewspaperIcon size={ 24 } style={ Tailwind`text-primary--red opacity-70` }/>
                                                    <View style={ Tailwind`flex flex-col ml-5` }>
                                                        <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-50` }>
                                                            Ringkasan Penjualan
                                                        </Text>
                                                        <Text style={ Tailwind`font-rubik-medium text-base text-primary--red opacity-70` }>
                                                            Tanggal { report.created_at.split(" ")[0] }
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
                        <View style={ Tailwind`h-12` }/>
                    </ScrollView>
                </View>
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
        user : state.user
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(LogReport)